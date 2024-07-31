import styles from './modalMeetup.module.scss';
import { IoMdCloseCircle } from "react-icons/io";

interface ModalMeetupProps {
  children: React.ReactNode;
  method: (value: boolean) => void;
}

const ModalMeetup = ({children, method}: ModalMeetupProps) => {
  return (
    <div className={styles.containerModal}>
      <div className={styles.bodyModal}>
        <div onClick={() => method(false)} className={styles.containerButtonClose}>
          <IoMdCloseCircle size="1.3rem" color='#ffa724' />
        </div>
        {children}
      </div>
    </div>
  )
};

export default ModalMeetup;
