require('./bootstrap');

require('moment');

import Vue from 'vue';
import moment from 'moment'

import {InertiaApp} from '@inertiajs/inertia-vue';
import {InertiaForm} from 'laravel-jetstream';
import PortalVue from 'portal-vue';

Vue.mixin({methods: {route}});
Vue.use(InertiaApp);
Vue.use(InertiaForm);
Vue.use(PortalVue);

const app = document.getElementById('app');


new Vue({
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
}).$mount(app);
Vue.directive("uppercase", {
    update: function (el) {
        el.value = el.value.toUpperCase()
    }
});
Vue.directive('phone', {
    bind(el) {
        el.oninput = function (e) {
            if (!e.isTrusted) {
                return;
            }

            const x = this.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
            this.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
            el.dispatchEvent(new Event('input'));
        }
    },
});

Vue.filter('formatDate', function (value) {
    if (value) {
        return moment(String(value)).format('MM/DD/YYYY hh:mm')
    }
});

var notifications = [];
const NOTIFICATION_TYPES = {
    NewTask: 'App\\Notifications\\NewTask'
};
