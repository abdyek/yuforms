Vue.use(Vuex);

const state = {
    formTitle:"Yeni Form",
    questionIndex: 0,
    questions:[],
    formComponentList: [
        { id:0, name:'Kısa Cevap', value:'input-text', checked:false },
        { id:1, name:'Çoktan Seçmeli', value:'input-radio', checked:false },
        { id:2, name:'Çoklu Seçmeli', value:'input-checkbox', checked:false }
    ],
    sent:false,
    formSlug:"ehi ehii",
    formResponseTitle: "",
    formResponseMessage: "",
    formResponseColor:"",
    responseSuccessful:true
};

const getters = {
    questionsReadyToSend: function() {
        return state.questions.filter(function(question) {
            return question.deleted==false
        })
    }
};

const mutations = {
    setFormTitle(state, title) {
        state.formTitle = title;
    },
    addQuestion(state) {
        state.questions.push({
            id:state.questionIndex,
            questionText:"",
            deleted:false,
            options: [
                {
                    id:0,
                    placeholder:"Seçenek 1",
                    value:""
                }
            ]
        });
        state.questionIndex = state.questionIndex + 1;
    },
    createQuestion(state, obj) {
        Vue.set(state.questions[obj.id], 'questionText', obj.questionText);
    },
    deleteQuestion(state, id) {
        Vue.set(state.questions[id], 'deleted', true);
    },
    updateOptions(state, obj) {
        Vue.set(state.questions[obj.id], 'options', obj.options);
    },
    sendResponse(state, obj) {
        state.sent = true;
        state.formResponseTitle = obj.formResponseTitle;
        state.formResponseMessage = obj.formResponseMessage;
        state.formResponseColor = obj.formResponseColor;
        state.responseSuccessful = obj.responseSuccessful;
    },
    changeSlug(state, formSlug) {
        state.formSlug = formSlug;
    }
};

const actions = {
    setFormTitle({commit}, title) {
        commit('setFormTitle', title);
    },
    addQuestion({commit}) {
        commit('addQuestion');
    },
    createQuestion({commit}, obj) {
        commit('createQuestion', obj);
    },
    deleteQuestion({commit}, id) {
        commit('deleteQuestion', id);
    },
    updateOptions({commit}, obj) {
        commit('updateOptions', obj);
    },
    sendForm({commit, getters}) {
        fetch('api/createForm', {
            method: 'POST',
            header: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(
                getters.questionsReadyToSend
            )
        }).then((response)=>{
            if(!response.ok) throw new Error(response.status);
            else return response.json();
        }).then((json)=>{
            commit('changeSlug', json.formSlug);
            commit('sendResponse', {
                formResponseTitle: "Form Oluşturuldu",
                formResponseMessage: "Başarılı bir şekilde form oluşturuldu",
                formResponseColor: "green",
                responseSuccessful: true
            });
        }).catch((error)=>{
            commit('sendResponse', {
                formResponseTitle: error.message,
                formResponseMessage: "Beklenmedik bir hata oldu",
                formResponseColor: "red",
                responseSuccessful: false
            });
        });
    },
    goEditForm() {
        changePage('/form-duzenle?slug=' + state.formSlug);
    },
    goShareForm() {
        console.log(state.formSlug);
        changePage('/form-paylas?slug=' + state.formSlug);
    }
};

const store = new Vuex.Store({
    state,
    getters,
    mutations,
    actions
});
