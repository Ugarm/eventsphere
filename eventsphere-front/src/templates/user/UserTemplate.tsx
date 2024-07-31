import { Outlet } from "react-router-dom";
import NavBar from "../../components/common/navbar/NavBar.tsx";
import styles from "./usertemplate.module.scss";
import Notification from "../../components/common/notification/Notification.tsx";

const UserTemplate = () => {
  return (
    <div className={styles.userTemplate}>
      <Notification />
      <NavBar />
      <Outlet />
      {/* <Footer /> */}
    </div>
  );
};

export default UserTemplate;
