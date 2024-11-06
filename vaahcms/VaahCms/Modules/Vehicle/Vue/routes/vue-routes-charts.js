let routes= [];
let routes_list= [];

import Charts from '../pages/charts/Charts.vue'

routes_list = {
    path: '/charts',
    name: 'charts',
    component: Charts,
    props: true,
};

routes.push(routes_list);

export default routes;

