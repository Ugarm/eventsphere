import styles from './meetupcard.module.scss';

interface meetupCardProps {
    meetup: any
}

const MeetupCard = ({ meetup }: meetupCardProps) => {
    return (
        <div className={styles.card} onClick={() => {}}>
            <div className={styles.photoContainer} style={{ backgroundImage: `url(${meetup.image})` }}>
            </div>
            <div className={styles.content}>
                <div className={styles.titleRow}>
                    <h3 className={styles.title}>{meetup.title}</h3>
                    <p className={styles.type}>{meetup.type}</p>
                </div>
                <p className={styles.location}>{meetup.location}</p>
                <p className={styles.date}>{meetup.date}</p>
                <p className={styles.participants}>Participants max : {meetup.maxParticipants}</p>
            </div>
        </div>
    );
};

export default MeetupCard;
