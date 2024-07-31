import { FaUser } from "react-icons/fa";
import { MdOutlineBusinessCenter } from "react-icons/md";
import { Link, NavLink, Outlet, useLocation } from "react-router-dom";
import styles from "./registerpage.module.scss";
import logo from "../../../../../src/images/logo.webp";

const RegisterPage = () => {
  const location = useLocation();
  return (
    <main className={styles.mainRegisterPage}>
      <div className={styles.containerRegisterInfos}>
        <img src={logo} alt="Logo event sphere" />
        <div>
          <h2>Inscription</h2>
          <p>
            Bienvenue sur Event Sphere, inscrivez vous pour découvrir les différents événements qui vous sont proposés, en vous inscrivant.
          </p>
          <p>
            Déjà inscrit ? &nbsp;
            <Link className={styles.linkRegisterForm} to="/login">
              Connectez vous
            </Link>
          </p>
        </div>
      </div>
      <div className={styles.containerRegisterForm}>
        <nav className={styles.navRegister}>
          <NavLink
            className={({ isActive }) => {
              return isActive ? styles.linkNavRegisterActive : styles.linkNavRegister;
            }}
            to="user"
            title="Inscription utilisateur"
          >
            <FaUser size="45%" color="#fff" />
          </NavLink>
          <p>{location.pathname.split('/').includes('user') ? "Utilisateur" : "Organisme"} </p>
          <NavLink
            className={({ isActive }) => {
              return isActive ? styles.linkNavRegisterActive : styles.linkNavRegister;
            }}
            to="organism"
            title="inscription associatif"
          >
            <MdOutlineBusinessCenter size="45%" color="#fff" />
          </NavLink>
        </nav>
        <Outlet />
      </div>
    </main>
  );
};

export default RegisterPage;
