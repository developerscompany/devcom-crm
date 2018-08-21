import Vue from 'vue';
import VueResource from 'vue-resource';

import HostingList from './components/admin/hosting/list'


Vue.use(VueResource);
Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');
Vue.http.options.emulateJSON = true;

const app = new Vue({
    el: '#app',
    components: {
        HostingList,
    }
});
