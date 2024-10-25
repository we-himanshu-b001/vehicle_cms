let routes= [];

import dashboard from "./vue-routes-dashboard";
import vehicle from "./vue-routes-vehicles";
import taxonomies from "./vue-routes-taxonomies";

routes = routes.concat(taxonomies);
routes = routes.concat(vehicle);
routes = routes.concat(dashboard);

export default routes;
