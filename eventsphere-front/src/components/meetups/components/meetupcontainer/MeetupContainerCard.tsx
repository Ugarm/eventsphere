import MeetupCard from "../meetupcard/MeetupCard.tsx";
import styles from "./meetupcontainercard.module.scss";
import {useState} from "react";
import Pagination from "../numberpagination/Pagination.tsx";

interface MeetupContainerCardProps {
    meetups: any[];
}

const MeetupContainerCard = ({meetups}: MeetupContainerCardProps) => {
    const [currentPage, setCurrentPage] = useState(1);
    const [meetupsPerPage] = useState(20);

    const indexOfLastMeetup = currentPage * meetupsPerPage;
    const indexOfFirstMeetup = indexOfLastMeetup - meetupsPerPage;
    const currentMeetups = meetups.slice(indexOfFirstMeetup, indexOfLastMeetup);

    // Changer de page
    const paginate = (pageNumber: number) => setCurrentPage(pageNumber);

    return (
        <>
            <div className={styles.meetupGrid}>
                {currentMeetups.map(meetup => (
                    <MeetupCard key={meetup.id} meetup={meetup} />
                ))}
            </div>
            <Pagination
                meetupsPerPage={meetupsPerPage}
                totalMeetups={meetups.length}
                paginate={paginate}
                currentPage={currentPage}
            />
        </>
    )
}

export default MeetupContainerCard;
