import './App.css'
import {getUser, handleLogout} from "./api/apiClient.jsx";
import {NavLink} from "react-router";

function App() {
  return (
      <>
          <button onClick={handleLogout}>Logout</button>
          <button onClick={getUser}>Get User</button>

          <nav>
              <NavLink to="/home" end>
                  Home
              </NavLink>
              <br/>
              <NavLink to="/login" end>
                  Login
              </NavLink>
              <br/>
              <NavLink to="/registration">Registration</NavLink>
              <br/>
              <NavLink to="/store-new-book">New Book</NavLink>
              <br/>
              <NavLink to="/books">Books</NavLink>
          </nav>
      </>
  )
}

export default App
