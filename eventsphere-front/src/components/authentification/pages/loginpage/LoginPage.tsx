import { Link, NavLink, Outlet, useLocation } from "react-router-dom";
import styles from "./loginpage.module.scss";
import logo from "../../../../../src/images/logo.webp"
import { FaUser } from "react-icons/fa";
import { MdOutlineBusinessCenter } from "react-icons/md";

const LoginPage = () => {
  const location = useLocation();
  
  return (
    <main className={styles.mainLoginPage}>
      <div className={styles.containerLogin}>
        <nav className={styles.navLogin}>
            <NavLink
              className={({ isActive }) => {
                return isActive ? styles.linkNavLoginActive : styles.linkNavLogin;
              }}
              to="user"
              title="Inscription utilisateur"
            >
              <FaUser size="45%" color="#fff" />
            </NavLink>
            <p>{location.pathname.split('/').includes('user') ? "Utilisateur" : "Organisme"}</p>
            <NavLink
              className={({ isActive }) => {
                return isActive ? styles.linkNavLoginActive : styles.linkNavLogin;
              }}
              to="organism"
              title="inscription associatif"
            >
              <MdOutlineBusinessCenter size="45%" color="#fff" />
            </NavLink>
          </nav>
          <Outlet />
      </div>
      <div className={styles.containerLoginInfos}>
        <img src={logo} alt="Logo Event Sphere" />
        <div>
          <h2>Connexion</h2>
          <p>
            Découvrer les différents événements qui vous sont proposés en vous, en vous connectant à votre compte
          </p>
          <p>
            Pas encore inscrit ? &nbsp;
            <Link className={styles.linkLoginForm} to="/register">
              Inscrivez vous
            </Link>
          </p>
        </div>
      </div>
    </main>
  );
};

export default LoginPage;
