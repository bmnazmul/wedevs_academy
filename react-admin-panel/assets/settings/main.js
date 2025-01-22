import domReady from "@wordpress/dom-ready";
import { createRoot } from "@wordpress/element";
import { RouterProvider } from "react-router-dom";

  import router from "./router";


domReady(function () {
  const root = createRoot(document.getElementById("react-admin-setting-app"));

  root.render(<RouterProvider router={router} />);
});
