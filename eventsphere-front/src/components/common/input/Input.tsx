/* eslint-disable @typescript-eslint/no-explicit-any */
import styles from "./input.module.scss";

interface InputProps {
  type:
    | "text"
    | "password"
    | "email"
    | "number"
    | "tel"
    | "url"
    | "search"
    | "date"
    | "time"
    | "datetime-local"
    | "month"
    | "week"
    | "color";
  defaultValue?: string;
  placeholder?: string;
  name: string;
  id: string;
  register?: any;
}

const Input = ({
  type = "text",
  defaultValue,
  name,
  id,
  register,
  placeholder,
}: InputProps) => {
  return (
    <input
      type={type}
      defaultValue={defaultValue}
      id={id}
      name={name}
      placeholder={placeholder}
      {...register(name)}
      className={styles.input}
    />
  );
};

export default Input;
