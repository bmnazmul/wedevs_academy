import { createHashRouter } from "react-router-dom";

import App from "./components/App";
import Genarel from "./components/Genarel";
import About from "./components/About";

const router = createHashRouter([
  {
    path: "/",
    element: <App />,
    children: [
      {
        path: "",
        element: <Genarel />,
      },
      {
        path: "/about",
        element: <About />,
      },
    ],
  },
]);

export default router;
