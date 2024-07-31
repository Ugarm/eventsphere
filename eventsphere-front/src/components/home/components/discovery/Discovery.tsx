import styles from './discovery.module.scss';

type DiscoveryProps = {
    title: string;
    description: string;
    imageUrl: string;
};

const Discovery = ({ title, description, imageUrl }: DiscoveryProps) => {
    return (
        <div className={styles.discovery}>
            <img className={styles.logo} src={imageUrl} alt="Discovery Logo" />
            <div className={styles.content}>
                <h2 className={styles.title}>{title}</h2>
                <p className={styles.text}>{description}</p>
            </div>
        </div>
    );
};

export default Discovery;
