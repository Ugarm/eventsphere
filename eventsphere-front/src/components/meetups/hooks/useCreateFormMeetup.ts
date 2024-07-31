import { yupResolver } from "@hookform/resolvers/yup";
import * as yup from "yup";
import { useForm } from "react-hook-form";
import { useMutation } from "@tanstack/react-query";
import { useMeetupContext } from "./useFunctionContext";
import { meetup } from "../types/types";

const useCreateFormMeetup = () => {
  const { createMeetup, setModalMeetup } = useMeetupContext();
  
  const schema = yup.object().shape({
    meetup_name: yup.string().required("Le nom du meetup est requis"),
    meetup_description: yup.string(),
    meetup_date: yup.date().required("La date du meetup est requise"),
    meetup_city: yup.string().required("La ville du meetup est requise"),
    meetup_region: yup.string().required("La région du meetup est requise"),
    meetup_address: yup.string().required("L'adresse du meetup est requise"),
    meetup_event_type: yup.string().required("Le type d'événement est requis"),
    meetup_gps_coordinates: yup.string().required("Les coordonnées GPS sont requises"),
    max_participants: yup.number(),
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
    mutationFn: createMeetup,
    onSuccess: () => {
      console.log("MEETUP Success");
      reset();
      setModalMeetup(false);
    },
    onError: () => {
      console.log("Error");
    },
  });

  const handleCreateMeetup = (data: meetup) => {
    
    const dataFormatted = {
      ...data,
      user_id: 1,
    };

    mutate(dataFormatted);

  };

  return {
    handleSubmit,
    handleCreateMeetup,
    register,
    errors,
    isSuccess,
    isError,
  };
};

export { useCreateFormMeetup };
