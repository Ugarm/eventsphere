import styles from './footer.module.scss';
import Button from "../button/Button.tsx";

const Footer = () => {
    return (
        <footer className={styles.footer}>
            <div className={styles.socialMedia}>
                <img src={"/src/images/facebook.png"} alt="Facebook"/>
                <img src={"/src/images/x.png"} alt="X"/>
                <img src={"/src/images/instagram.png"} alt="Instagram"/>
            </div>
            <div className={styles.links}>
                <a href="/about">Qui sommes nous</a>
            </div>
            <div className={styles.newsletter}>
                <h2>Newsletter</h2>
                <div className={styles.subscription}>
                    <input type="email" placeholder="email@gmail.com" />
                    <Button text={"S'abonner"} />
                </div>
            </div>
            <div className={styles.partners}>
                <a href="/partners">Nos partenaires</a>
            </div>
        </footer>
    );
};

export default Footer;
