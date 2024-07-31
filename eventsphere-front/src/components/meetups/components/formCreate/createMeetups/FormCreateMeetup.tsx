/* eslint-disable @typescript-eslint/no-explicit-any */
import Button from "../../../../common/button/Button.tsx";
import GroupControls from "../../../../common/groupControls/GroupControls.tsx";
import { useCreateFormMeetup } from "../../../hooks/useCreateFormMeetup.ts";
import { meetup } from "../../../types/types.ts";
import styles from "./formMeetup.module.scss";

const FormCreateMeetup = () => {
  const { register, handleSubmit, handleCreateMeetup, errors } = useCreateFormMeetup();

  return (
    <form
      className={styles.formCreateMeetup}
      onSubmit={handleSubmit((data: meetup) => handleCreateMeetup(data as meetup))}
    >
      <h2>Créer votre meetup</h2>
      <GroupControls
        name="meetup_name"
        id="meetup_name"
        register={register}
        type="text"
        error={errors}
        placeholder="Nom du meetup"
      />
      <GroupControls
        name="meetup_description"
        id="meetup_description"
        register={register}
        textarea={true}
        error={errors}
        placeholder="Description du meetup"
      />
      <div>
        <GroupControls
          name="meetup_date"
          id="meetup_date"
          register={register}
          type="date"
          error={errors}
        />
        <GroupControls
          name="max_participants"
          id="max_participants"
          register={register}
          type="number"
          error={errors}
          placeholder="Nombre de participants"
        />
      </div>
      <div>
        <GroupControls
          name="meetup_event_type"
          id="meetup_event_type"
          register={register}
          type="text"
          error={errors}
          placeholder="Type d'événement"
        />
        <GroupControls
          name="meetup_gps_coordinates"
          id="meetup_gps_coordinates"
          register={register}
          type="text"
          error={errors}
          placeholder="Coordonnées GPS"
        />
      </div>
      <div>
      <GroupControls
        name="meetup_city"
        id="meetup_city"
        register={register}
        type="text"
        error={errors}
        placeholder="Ville de votre meetup"
      />
      <GroupControls
        name="meetup_region"
        id="meetup_region"
        register={register}
        type="text"
        error={errors}
        placeholder="Région de votre meetup"
      />
      </div>
      <GroupControls
        name="meetup_address"
        id="meetup_address"
        register={register}
        type="text"
        error={errors}
        placeholder="Adresse de votre meetup"
      />
      
      <Button type="submit" text="Ajouter un meetup" />
    </form>
  );
};

export default FormCreateMeetup;
