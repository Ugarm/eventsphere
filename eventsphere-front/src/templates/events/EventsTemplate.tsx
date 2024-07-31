import NavBar from "../../components/common/navbar/NavBar.tsx";
import { Outlet } from "react-router-dom";
import Footer from "../../components/common/footer/Footer.tsx";
import styles from "./eventstemplate.module.scss";
import Notification from "../../components/common/notification/Notification.tsx";

const EventsTemplate = () => {
    return (
        <div className={styles.eventsTemplate}>
            <Notification />
            <NavBar />
            <Outlet />
            <Footer />
        </div>
    );
};

export default EventsTemplate;
