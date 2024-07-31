/* eslint-disable @typescript-eslint/no-explicit-any */
import { Link } from "react-router-dom";
import { useRegisterForm } from "../../../hooks/useRegisterForm.ts";
import { registerUserData } from "../../../types/types.ts";
import styles from "./registerFormUser.module.scss";
import Button from "../../../../common/button/Button.tsx";
import GroupControls from "../../../../common/groupControls/GroupControls.tsx";

const RegisterFormUser = () => {
  const { handleSubmit, handleSignup, register, errors } = useRegisterForm();
  return (
    <form
      className={styles.registerFormUser}
      action=""
      onSubmit={handleSubmit((data) => handleSignup(data as registerUserData))}
    >
      <h2>Inscription</h2>
      <div className={styles.formSection}>
        <GroupControls
          name="lastname"
          id="lastname-register"
          register={register}
          type="text"
          error={errors}
          placeholder="Nom"
        />
        <GroupControls
          name="firstname"
          id="firstname-register"
          register={register}
          type="text"
          placeholder="Prénom"
          error={errors}
        />
      </div>
      <div className={styles.formSection}>
        <GroupControls
          name="nickname"
          id="nickname-register"
          register={register}
          type="text"
          error={errors}
          placeholder="Pseudo"
        />
        <GroupControls
          name="email"
          id="email-register"
          register={register}
          type="email"
          error={errors}
          placeholder="Email"
        />
      </div>
      <div className={styles.formSection}>
        <GroupControls
          name="city"
          id="city-register"
          register={register}
          type="text"
          error={errors}
          placeholder="Ville"
        />
        <GroupControls
          name="postal_code"
          id="postal_code-register"
          register={register}
          type="text"
          error={errors}
          placeholder="Code postal"
        />
      </div>
      <GroupControls
        name="address"
        id="address-register"
        register={register}
        type="text"
        error={errors}
        placeholder="Adresse principale"
      />
      <GroupControls
        name="address_two"
        id="address-two-register"
        register={register}
        type="text"
        error={errors}
        placeholder="Complément d'adresse"
      />
      <GroupControls
        name="phone"
        id="phone-register"
        register={register}
        type="tel"
        error={errors}
        placeholder="Numéro de téléphone"
      />
      <GroupControls
        name="password"
        id="password-register"
        register={register}
        type="password"
        error={errors}
        placeholder="Mot de passe"
      />
      <GroupControls
        name="confirm_password"
        id="confirm_password-register"
        register={register}
        type="password"
        error={errors}
        placeholder="Confirmation mot de passe"
      />
      <div className={styles.containerInfosRegister}>
        <p>Déjà inscrit ?</p>
        <Link to="/login">Connectez vous</Link>
      </div>
      <Button text="S'enregistrer" type="submit" />
    </form>
  );
};

export default RegisterFormUser;
