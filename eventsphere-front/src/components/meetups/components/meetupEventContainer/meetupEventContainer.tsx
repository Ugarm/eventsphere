import styles from "./meetupEvent.module.scss";
import MeetupContainerCard from "../meetupcontainer/MeetupContainerCard.tsx";
import {useMeetupContext} from "../../hooks/useFunctionContext.ts";
import {useFilterContext} from "../../../../hooks/useFunctionContext.ts";

const MeetupEventContainer = ({ meetups, sortBy, sortMeetups }) => {
    const {setModalMeetup} = useMeetupContext();
    const {isEvent} = useFilterContext();

    return (
        <div className={styles.containerMeetup}>
            <div className={styles.meetupHeader}>
                <div className={styles.btnCreateMeetup} onClick={() => setModalMeetup(true)}>
                    {isEvent ? <p>Créer un événement</p> : <p>Créer un meetup</p>}
                </div>
                <div className={styles.containerHeaderInfos}>
                    <h1>{meetups.length} activités</h1>
                    <div className={styles.sortDropdown}>
                        <select
                            value={sortBy}
                            onChange={(e) => sortMeetups(e.target.value)}
                            className={styles.dropdown}
                        >
                            <option value="recent">Les plus récents</option>
                            <option value="popular">Les plus populaires</option>
                            <option value="oldest">Les plus anciens</option>
                        </select>
                    </div>
                </div>
            </div>
            <div className={styles.meetupGrid}>
                <MeetupContainerCard meetups={meetups} />
            </div>
        </div>
    );
};

export default MeetupEventContainer;