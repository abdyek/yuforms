Vue.use(Vuex);

const state = {
    formTitle:""
};

const getters = {
    
};

const mutations = {
    setFormTitle(state, title) {
        state.formTitle = title;
    },
};

const actions = {
    setFormTitle({commit}, title) {
        commit('setFormTitle', title);
    },
};

const store = new Vuex.Store({
    state,
    getters,
    mutations,
    actions
});
