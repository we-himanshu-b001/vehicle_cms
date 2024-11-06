let routes= [];

import dashboard from "./vue-routes-dashboard";
import vehicle from "./vue-routes-vehicles";
import taxonomies from "./vue-routes-taxonomies";
import customer from "./vue-routes-customers";
import consumerapplications from "./vue-routes-consumerapplications";
import ChartImport from "./vue-routes-charts";

routes = routes.concat(consumerapplications);
routes = routes.concat(customer);
routes = routes.concat(taxonomies);
routes = routes.concat(vehicle);
routes = routes.concat(dashboard);
routes = routes.concat(ChartImport);


export default routes;
