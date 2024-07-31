import styles from './eventcardhome.module.scss';

type EventCardProps = {
    imageUrl: string;
    cityName: string;
    eventType: string;
    eventDate: string;
    description: string;
};

const EventCardHome = ({ imageUrl, cityName, eventType, eventDate, description }: EventCardProps) => {
    return (
        <div className={styles.eventCardHome}>
            <div className={styles.imageWrapper}>
                <img src={imageUrl} alt={`Event in ${cityName}`} className={styles.eventImage} />
                <div className={styles.eventDetails}>
                    <h3 className={styles.cityName}>{cityName}</h3>
                    <span className={styles.eventDate}>{eventDate}</span>
                    <p className={styles.description}>{description}</p>
                    <span className={styles.eventType}>{eventType}</span>
                </div>
            </div>
        </div>
    );
};

export default EventCardHome;
