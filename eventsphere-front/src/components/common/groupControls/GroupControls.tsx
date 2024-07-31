/* eslint-disable @typescript-eslint/no-explicit-any */
import styles from "./groupControls.module.scss";
import Input from "../input/Input.tsx";
import { ErrorMessage } from "@hookform/error-message";
import Textarea from "../textarea/Textarea.tsx";

interface GroupControlsProps {
  name: string;
  id: string;
  register?: any;
  type?:
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
    | "checkbox"
    | "color";
  textarea?: boolean;
  error?: any;
  label?: string;
  defaultValue?: string;
  placeholder?: string;
}

const GroupControls = ({
  name,
  id,
  register,
  type,
  error,
  label,
  textarea,
  defaultValue,
  placeholder,
}: GroupControlsProps) => {
  return (
    <div className={styles.containerGroupControl}>
      {label && <label htmlFor={id}>{label}</label>}
      {textarea ? (
        <Textarea
          id={id}
          name={name}
          register={register}
          defaultValue={defaultValue}
          placeholder={placeholder}
        />
      ) : (
        <Input
          id={id}
          name={name}
          type={type ? type : "text"}
          register={register}
          className={styles.input}
          defaultValue={defaultValue}
          placeholder={placeholder}
        />
      )}
      {error ? (
        <ErrorMessage
          errors={error}
          name={name}
          render={({ message }) => <p>{message}</p>}
        />
      ) : null}
    </div>
  );
};

export default GroupControls;
