import { yupResolver } from "@hookform/resolvers/yup";
import * as yup from "yup";
import { useForm } from "react-hook-form";
import { useMutation } from "@tanstack/react-query";
import {useEventContext} from "./useFunctionContext";
import { event } from "../types/types";

const useCreateFormEvent = () => {
    const { createEvent, setModalEvent } = useEventContext();

    const schema = yup.object().shape({
        event_name: yup.string().required("Le nom du event est requis"),
        event_description: yup.string(),
        event_date: yup.date().required("La date du event est requise"),
        event_city: yup.string().required("La ville du event est requise"),
        event_region: yup.string().required("La région du event est requise"),
        event_address: yup.string().required("L'adresse du event est requise"),
        event_host: yup.string().required("Le nom de l'organisation est requise"),
        event_type: yup.string().required("Le type d'événement est requis"),
        event_available_tickets: yup.number(),
        is_free_event: yup.boolean(),
        //ticket_link: yup.string(),
        event_price:yup.number(),
    });

    const {
        handleSubmit,
        register,
        formState: { errors },
        reset,
    } = useForm({
        resolver: yupResolver(schema),
    });

    const { mutate, isError, isSuccess } = useMutation({
        mutationFn: createEvent,
        onSuccess: () => {
            console.log("EVENT Success");
            reset();
            setModalEvent(false);
        },
        onError: () => {
            console.log("Error");
        },
    });

    const handleCreateEvent = (data: event) => {

        const dataFormatted = {
            ...data,
            organization_account_id: 1,
        };

        console.log(dataFormatted);

        //mutate(dataFormatted);

    };

    return {
        handleSubmit,
        handleCreateEvent,
        register,
        errors,
        isSuccess,
        isError,
    };
};

export { useCreateFormEvent };
