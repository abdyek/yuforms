Vue.use(Vuex);

const state = {
    formTitle:"Yeni Form",
    questionIndex: 0,
    questions:[],
    formComponentList: [
        { id:0, name:'Kısa Cevap', value:'input-text', checked:false },
        { id:1, name:'Çoktan Seçmeli', value:'input-radio', checked:false },
        { id:2, name:'Çoklu Seçmeli', value:'input-checkbox', checked:false }
    ]
};

const getters = { };

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
};

const store = new Vuex.Store({
    state,
    getters,
    mutations,
    actions
});
