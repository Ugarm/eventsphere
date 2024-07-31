import { useState } from "react";
import { GiHamburgerMenu } from "react-icons/gi";
import { IoClose } from "react-icons/io5";
import { Link } from "react-router-dom";
import styles from "./navbar.module.scss";
// import frenchFlag from "../../../../src/images/frenchFlag.svg"
// import englandFlag from "../../../../src/images/englandFlag.jpg"

const NavBar = () => {
  const [navIsOpen, setNavIsOpen] = useState(false);
  return (
    <div className={styles.containerNavbar}>
      <div className={styles.containerNavbarLogo}>
        <Link className={styles.logoLink} to="/">
          <div className={styles.logoContainer}>
            <img
              className={styles.logoContainerImage}
              src="/eventsphere-front/src/images/logo.webp"
              alt="Event Sphere"
            />
            <h1 className={styles.logoContainerTitle}>Event Sphere</h1>
          </div>
        </Link>
      </div>
      <div
        onClick={() =>
          setNavIsOpen((prevState) => (prevState === false ? true : false))
        }
        className={styles.containerBurger}
      >
        {!navIsOpen ? <GiHamburgerMenu size="2rem" /> : <IoClose size="2rem" />}
      </div>
      <nav
        className={
          navIsOpen
            ? styles.containerNavbarLinks +
              " " +
              styles.containerNavbarLinksActive
            : styles.containerNavbarLinks
        }
      >
        <select className={styles.languageSelector}>
          <option className={styles.french} value="fr">
            Français
          </option>
          <option className={styles.english} value="en">
            English
          </option>
        </select>
        <Link className={styles.navLink} to="/meetups">
          Événements
        </Link>
        <Link className={styles.navLink} to="/register">
          Inscription
        </Link>
        <Link className={styles.navLink} to="/login">
          Connexion
        </Link>
      </nav>
    </div>
  );
};

export default NavBar;
