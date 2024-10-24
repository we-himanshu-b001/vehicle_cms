let routes= [];
let routes_list= [];

import List from '../pages/vehicles/List.vue'
import Form from '../pages/vehicles/Form.vue'
import Item from '../pages/vehicles/Item.vue'

routes_list = {

    path: '/vehicles',
    name: 'vehicles.index',
    component: List,
    props: true,
    children:[
        {
            path: 'form/:id?',
            name: 'vehicles.form',
            component: Form,
            props: true,
        },
        {
            path: 'view/:id?',
            name: 'vehicles.view',
            component: Item,
            props: true,
        }
    ]
};

routes.push(routes_list);

export default routes;

