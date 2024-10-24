let routes= [];

import dashboard from "./vue-routes-dashboard";
import vehicle from "./vue-routes-vehicles";

routes = routes.concat(vehicle);
routes = routes.concat(dashboard);

export default routes;
