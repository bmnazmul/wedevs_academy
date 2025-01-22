
import { Outlet} from "react-router-dom";

import Navigation from './Navigation';

function App() {
  return (
    <div className="wrap">
      <h1>React Settings</h1>
      <Navigation />
      <Outlet />
    </div>
  );
}

export default App;
