import List from './components/List.vue';
import Add from './components/Add.vue';
import Edit from './components/Edit.vue';

export const routes = [
    {
        name: 'welcome',
        path: '/',
        component: Welcome
    },
    {
        name: 'list',
        path: '/list',
        component: List
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: Edit
    },
    {
        name: 'add',
        path: '/add',
        component: Add
    }
]
