import Vue from 'vue';
import VueI18n from 'vue-i18n';

Vue.use(VueI18n)

export default ({ app, store }) => {
    app.i18n = new VueI18n({
        locale: store.getters.default_language,
        messages: {
            'en': require('~/locales/en.json'),
            'vi': require('~/locales/vi.json'),
        },
    });
}