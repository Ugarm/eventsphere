/* eslint-disable @typescript-eslint/no-explicit-any */
import Button from "../../../../common/button/Button.tsx";
import GroupControls from "../../../../common/groupControls/GroupControls.tsx";
import { event } from "../../../types/types.ts";
import styles from "./formEvent.module.scss";
import {useState} from "react";
import {useCreateFormEvent} from "../../../hooks/useCreateFormEvent.ts";

const FormCreateEvent = () => {
    const { register, handleSubmit, handleCreateEvent, errors } = useCreateFormEvent();
    const [isFree, setIsFree] = useState(false);
    const handleCheckedPrice = (e: React.MouseEvent<HTMLInputElement>) => {
        const checked = e?.currentTarget?.checked;
        setIsFree(checked)
    }

    return (
        <form
            className={styles.formCreateMeetup}
            onSubmit={handleSubmit((data: event) => handleCreateEvent(data as event))}
        >
            <h2>Créer votre événement</h2>
            <GroupControls
                name="event_name"
                id="event_name"
                register={register}
                type="text"
                error={errors}
                placeholder="Nom de l'événement"
            />
            <GroupControls
                name="event_description"
                id="event_description"
                register={register}
                textarea={true}
                error={errors}
                placeholder="Description de l'événement"
            />
            <div>
                <GroupControls
                    name="event_date"
                    id="event_date"
                    register={register}
                    type="date"
                    error={errors}
                />
                <GroupControls
                    name="event_available_tickets"
                    id="event_available_tickets"
                    register={register}
                    type="number"
                    error={errors}
                    placeholder="Nombre de participants"
                />
            </div>
            <GroupControls
                name="event_host"
                id="event_host"
                register={register}
                type="text"
                error={errors}
                placeholder="Nom de la société"
            />
            <div>
                {/*TODO : Pour ce groupcontrols ajouté un select avec les différents types de catégorie*/}
                <GroupControls
                    name="event_type"
                    id="event_type"
                    register={register}
                    type="text"
                    error={errors}
                    placeholder="Type d'événement"
                />
            </div>
            <div>
                <GroupControls
                    name="event_city"
                    id="event_city"
                    register={register}
                    type="text"
                    error={errors}
                    placeholder="Ville de votre événement"
                />
                <GroupControls
                    name="event_region"
                    id="event_region"
                    register={register}
                    type="text"
                    error={errors}
                    placeholder="Région de votre événement"
                />
            </div>
            <GroupControls
                name="event_address"
                id="event_address"
                register={register}
                type="text"
                error={errors}
                placeholder="Adresse de votre événement"
            />
            <div className={styles.containerIsFree}>
                <div className={styles.checkboxIsFree}>
                    <label>Evénement gratuit ? </label>
                    <input
                        name="is_free_event"
                        {...register("is_free_event")}
                        id="is_free_event"
                        type="checkbox"
                        onChange={handleCheckedPrice}
                    />
                </div>
                {!isFree && (
                    <GroupControls
                        name="event_price"
                        id="event_price"
                        register={register}
                        type="number"
                        error={errors}
                        placeholder="Prix du ticket (€)"
                    />
                )}
            </div>

            <Button type="submit" text="Ajouter un événement" />
        </form>
    );
};

export default FormCreateEvent;
