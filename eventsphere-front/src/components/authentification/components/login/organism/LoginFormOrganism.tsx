import GroupControls from '../../../../common/groupControls/GroupControls'
import styles from "./loginFormOrganisme.module.scss"
import { Link } from 'react-router-dom'
import Button from '../../../../common/button/Button'
import { loginUserData } from '../../../types/types'
import { useLoginOrganismForm } from '../../../hooks/useLoginOrganismForm'

const LoginFormOrganism = () => {
  const { handleSubmit, register, errors, handleLoginOrganism} = useLoginOrganismForm()
  return (
    <form
      className={styles.loginFormOrganism}
      onSubmit={handleSubmit((data) => handleLoginOrganism(data as loginUserData))}
    >
      <h2>Connexion organisme</h2>
      <GroupControls
        name="personal_email"
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
  )
}

export default LoginFormOrganism