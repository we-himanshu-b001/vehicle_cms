let routes= [];
let routes_list= [];

import List from '../pages/consumerapplications/List.vue'
import Form from '../pages/consumerapplications/Form.vue'
import Item from '../pages/consumerapplications/Item.vue'

routes_list = {

    path: '/consumerapplications',
    name: 'consumerapplications.index',
    component: List,
    props: true,
    children:[
        {
            path: 'form/:id?',
            name: 'consumerapplications.form',
            component: Form,
            props: true,
        },
        {
            path: 'view/:id?',
            name: 'consumerapplications.view',
            component: Item,
            props: true,
        }
    ]
};

routes.push(routes_list);

export default routes;

