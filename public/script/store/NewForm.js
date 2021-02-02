Vue.use(Vuex);

const state = {
    formTitle:"Yeni Form",
    questionIndex: 0,
    questions:[] 
};

const getters = { };

const mutations = {
    setFormTitle(state, title) {
        state.formTitle = title;
    },
    addQuestion(state) {
        state.questions.push({
            id:state.questionIndex,
            questionText:""
        });
        state.questionIndex = state.questionIndex + 1;
    },
    createQuestion(state, obj) {
        console.log('in mutations', obj.id, obj.questionText);
        Vue.set(state.questions[obj.id], 'questionText', obj.questionText);
    },
    deleteQuestion(state, id) {
        state.questions = state.questions.filter(function(obj) {return obj.id!=id});
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
    }
};

const store = new Vuex.Store({
    state,
    getters,
    mutations,
    actions
});
