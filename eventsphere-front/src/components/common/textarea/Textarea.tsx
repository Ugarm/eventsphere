/* eslint-disable @typescript-eslint/no-explicit-any */
import styles from "./textarea.module.scss";
interface TextareaProps {
  name: string;
  id: string;
  register?: any;
  defaultValue?: string;
  placeholder?: string;
}

const Textarea = ({name, id, register, defaultValue, placeholder}: TextareaProps) => {
  return (
    <textarea className={styles.textarea} name={name} id={id} {...register(name)} defaultValue={defaultValue} placeholder={placeholder} ></textarea>
  )
}

export default Textarea