import { Link } from 'react-router-dom'
import styles from "./registerOrganism.module.scss"
import { useRegisterOrganismForm } from '../../../hooks/useRegisterOrganismForm'
import Button from '../../../../common/button/Button'
import GroupControls from '../../../../common/groupControls/GroupControls'
import { registerOrganismData } from '../../../types/types'

const RegisterOrganism = () => {
  const { 
    register, 
    handleSubmit, 
    handleSignupOrganism,
    errors,
  } = useRegisterOrganismForm()
  return (
    <form onSubmit={handleSubmit((data) => handleSignupOrganism(data as registerOrganismData))} action="" className={styles.registerFormOrganism}>
      <div className={styles.formSection}>
        <GroupControls
          name="personal_lastname"
          id="lastname-personal-organism-register"
          register={register}
          type="text"
          error={errors}
          placeholder="Nom"
        />
        <GroupControls
          name="personal_firstname"
          id="firstname-personal-organism-register"
          register={register}
          type="text"
          placeholder="Prénom"
          error={errors}
        />
      </div>
        <GroupControls
          name="personal_email"
          id="email-personal-organism-register"
          register={register}
          type="email"
          error={errors}
          placeholder="Email"
        />
      <div className={styles.formSection}>
      <GroupControls
          name="personal_address"
          id="address-personal-organism-register"
          register={register}
          type="text"
          error={errors}
          placeholder="Adresse"
          />
        <GroupControls
          name="personal_address_two"
          id="address_two-personal-organism-register"
          register={register}
          type="text"
          error={errors}
          placeholder="Complément d'adresse"
        />
      </div>
      <div className={styles.formSection}>
        <GroupControls
          name="personal_city"
          id="city-personal-organism-register"
          register={register}
          type="text"
          error={errors}
          placeholder="Ville"
        />
        <GroupControls
          name="personal_region"
          id="region-personal-organism-register"
          register={register}
          type="text"
          error={errors}
          placeholder="Région"
        />
      </div>
        <GroupControls
          name="personal_phone"
          id="phone-personal-organism-register"
          register={register}
          type="text"
          error={errors}
          placeholder="Téléphone"
        />
      <div className={styles.formSection}>
        <GroupControls
          name="password"
          id="password-organism-register"
          register={register}
          type="password"
          error={errors}
          placeholder="Mot de passe"
        />
        <GroupControls
          name="password_confirmation"
          id="password-confirmation-organism-register"
          register={register}
          type="password"
          error={errors}
          placeholder="Confirmation du mot de passe"
        />
      </div>
      <div className={styles.formSection}>
        <GroupControls
          name="organization_name"
          id="name-organism-register"
          register={register}
          type="text"
          error={errors}
          placeholder="Nom de l'organisation"
        />
        <GroupControls
          name="organization_email"
          id="email-organism-register"
          register={register}
          type="email"
          error={errors}
          placeholder="Email de l'organisation"
        />
      </div>
      <div className={styles.formSection}>
        <GroupControls
          name="organization_phone"
          id="phone-organism-register"
          register={register}
          type="text"
          error={errors}
          placeholder="Téléphone de l'organisation"
        />
      </div>
      <div className={styles.formSection}>
      <GroupControls
          name="organization_address"
          id="address-organism-register"
          register={register}
          type="text"
          error={errors}
          placeholder="Adresse de l'organisation"
        />
        <GroupControls
          name="organization_address_two"
          id="address-two-organism-register"
          register={register}
          type="text"
          error={errors}
          placeholder="Complément d'adresse de l'organisation"
        />
      </div>
      <div className={styles.formSection}>
        <GroupControls
          name="organization_city"
          id="city-organism-register"
          register={register}
          type="text"
          error={errors}
          placeholder="Ville de l'organisation"
        />
        <GroupControls
          name="organization_postal_code"
          id="postal_code-organism-register"
          register={register}
          type="text"
          error={errors}
          placeholder="Code postal de l'organisation"
        />
      </div>
      <div className={styles.formSection}>
        <GroupControls
          name="organization_region"
          id="region-organism-register"
          register={register}
          type="text"
          error={errors}
          placeholder="Région de l'organisation"
        />
        <GroupControls
          name="organization_type"
          id="type-organism-register"
          register={register}
          type="text"
          error={errors}
          placeholder="Type d'organisation"
        />
      </div>


      <div className={styles.containerInfosRegister}>
        <p>Déjà inscrit ?</p>
        <Link to="/login">Connectez vous</Link>
      </div>
      <Button text="S'enregistrer" type="submit" />
    </form>
  )
}

export default RegisterOrganism