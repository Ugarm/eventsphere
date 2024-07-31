import { Link } from "react-router-dom";
import { useLoginForm } from "../../../hooks/useLoginForm";
import { loginUserData } from "../../../types/types";
import styles from "./loginFormUser.module.scss";
import Button from "../../../../common/button/Button";
import GroupControls from "../../../../common/groupControls/GroupControls";

const LoginFormUser = () => {
  const { handleSubmit, handleLogin, register, errors } = useLoginForm();

  return (
    <form
      className={styles.loginFormUser}
      onSubmit={handleSubmit((data) => handleLogin(data as loginUserData))}
    >
      <h2>Connexion</h2>
      <GroupControls
        name="email"
        id="email-login"
        register={register}
        type="email"
        error={errors}
        placeholder="Email"
      />
      <GroupControls
        name="password"
        id="password-login"
        register={register}
        type="password"
        error={errors}
        placeholder="Mot de passe"
      />
      <div className={styles.boxInfosLoginForm}>
        <p>Pas encore inscrit ?</p>
        <Link className={styles.linkLoginForm} to="/register">
          Inscrivez vous
        </Link>
      </div>
      <Button type="submit" text="Se connecter" />
    </form>
  );
};

export default LoginFormUser;
