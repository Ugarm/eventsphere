import styles from './searchbar.module.scss';
import Button from "../../../common/button/Button.tsx";

const SearchBar = () => {
    return (
        <div className={styles.searchBar}>
            <h1 className={styles.title}>Event Sphere la plateforme de votre événement</h1>
            <p className={styles.subtitle}>Découvrez les événements qui vous correspondent.</p>
            <div className={styles.searchInputContainer}>
                <input type="text" placeholder="" className={styles.searchInput} />
                <Button />
            </div>
        </div>
    );
};

export default SearchBar;
