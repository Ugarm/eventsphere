import { Link } from 'react-router-dom';
import styles from './button.module.scss';
import search from '../../../images/logo.webp';

type ButtonProps = {
    text: string;
    onClick?: () => void;
    type?: "button" | "submit" | "reset";
    href?: string;
}

const Button = ({ text, onClick, type = "button", href }: ButtonProps) => {
    if (href) {
        return (
            <Link to={href} className={styles.button}>
                {text}
            </Link>
        );
    }

    return (
        <button className={styles.button} onClick={onClick} type={type}>
            <img src={search} className={styles.searchLogo}/>
        </button>
    );
};

export default Button;
