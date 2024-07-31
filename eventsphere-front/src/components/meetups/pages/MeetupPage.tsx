import styles from "./meetup.module.scss";
import Filter from "../components/filter/Filter.tsx";
import {useState} from "react";
import ModalMeetup from "../components/modal/ModalMeetup.tsx";
import { useMeetupContext } from "../hooks/useFunctionContext.ts";
import MeetupEventContainer from "../components/meetupEventContainer/meetupEventContainer.tsx";
import {useFilterContext} from "../../../hooks/useFunctionContext.ts";
import FormCreateMeetup from "../components/formCreate/createMeetups/FormCreateMeetup.tsx";
import FormCreateEvent from "../components/formCreate/createEvents/FormCreateEvents.tsx";

const events = [
    {
        id: 1,
        title: "Cours de Yoga",
        image: "../../../../../src/images/yoga.webp",
        location: "Toulon",
        type: "Sport",
        date: "02 mai 2025",
        maxParticipants: 20
    },
    {
        id: 2,
        title: "Tournoi de Foot",
        image: "../../../../../src/images/footsalle.jpg",
        location: "Lyon",
        type: "Sport",
        date: "02 avril 2025",
        maxParticipants: 12
    },
    {
        id: 3,
        title: "Cours de Yoga",
        image: "../../../../../src/images/yoga.webp",
        location: "Toulon",
        type: "Sport",
        date: "02 juillet 2025",
        maxParticipants: 20
    },
    {
        id: 4,
        title: "Tournoi de Foot",
        image: "../../../../../src/images/footsalle.jpg",
        location: "Lyon",
        type: "Sport",
        date: "02 juin 2025",
        maxParticipants: 12
    },
];

const meetups = [
    {
        id: 1,
        title: "Cours de tennis",
        image: "../../../../../src/images/yoga.webp",
        location: "Toulon",
        type: "Sport",
        date: "02 mai 2025",
        maxParticipants: 20
    },
    {
        id: 2,
        title: "Tournoi de Ping-Pong",
        image: "../../../../../src/images/footsalle.jpg",
        location: "Lyon",
        type: "Sport",
        date: "02 avril 2025",
        maxParticipants: 12
    },
    {
        id: 3,
        title: "Cours de Yoga",
        image: "../../../../../src/images/yoga.webp",
        location: "Toulon",
        type: "Sport",
        date: "02 juillet 2025",
        maxParticipants: 20
    },
    {
        id: 4,
        title: "Tournoi de Foot",
        image: "../../../../../src/images/footsalle.jpg",
        location: "Lyon",
        type: "Sport",
        date: "02 juin 2025",
        maxParticipants: 12
    },
];

const MeetupPage = () => {
    const { modalMeetup, setModalMeetup } = useMeetupContext();
    const [sortBy, setSortBy] = useState('recent'); // 'recent', 'popular', 'oldest'
    const {isEvent, setIsEvent} = useFilterContext();

    const sortMeetups = (option) => {
        setSortBy(option);
    };

    return (
        <main className={styles.mainContent}>
            <section className={styles.sectionMeetup}>
                {modalMeetup && <ModalMeetup method={setModalMeetup}>
                    {isEvent ? <FormCreateEvent/> : <FormCreateMeetup/>}
                </ModalMeetup>}
                <Filter method={setIsEvent} isEvent={isEvent} />
                {isEvent ? <MeetupEventContainer meetups={meetups} sortBy={sortBy} sortMeetups={sortMeetups} /> : <MeetupEventContainer meetups={events} sortBy={sortBy} sortMeetups={sortMeetups} />}
            </section>
        </main>
    );
};

export default MeetupPage;