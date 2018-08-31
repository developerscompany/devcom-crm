import Vue from 'vue';import VueResource from 'vue-resource';import Vuetify from 'vuetify'import "vuejs-datepicker"import HostingList from './components/admin/hosting/list'import HostingAdd from './components/admin/hosting/add'import HostingEdit from './components/admin/hosting/edit'import HostingCard from './components/admin/hosting/card'import HostingSale from './components/admin/hosting/sale'import HostingArchive from './components/admin/hosting/archive'import HostingCalendar from './components/admin/hosting/calendar'import HostingServers from './components/admin/hosting/servers'Vue.use(Vuetify);Vue.use(VueResource);Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');Vue.http.options.emulateJSON = true;const app = new Vue({    el: '#app-vue',    components: {        HostingList,        HostingAdd,        HostingEdit,        HostingCard,        HostingSale,        HostingArchive,        HostingCalendar,        HostingServers,    }});