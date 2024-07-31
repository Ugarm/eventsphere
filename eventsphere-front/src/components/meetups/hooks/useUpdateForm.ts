import { yupResolver } from "@hookform/resolvers/yup";
import * as yup from "yup";
import { useForm } from "react-hook-form";
import { useMutation } from "@tanstack/react-query";
import { useMeetupContext } from "./useFunctionContext";
import { meetup } from "../types/types";

const useUpdateForm = () => {
  const { updateMeetup } = useMeetupContext();

  const schema = yup.object().shape({
    meetup_name: yup.string().required(),
    meetup_description: yup.string().required(),
    meetup_date: yup.date().required(),
    meetup_city: yup.string().required(),
    meetup_region: yup.string().required(),
    meetup_address: yup.string().required(),
    meetup_gps_coordinates: yup.string().required(),
    meetup_event_type: yup.string().required(),
    max_participants: yup.number().required(),
    user_id: yup.number().required(),
  });

  const {
    handleSubmit,
    register,
    formState: { errors },
    reset,
  } = useForm({
    resolver: yupResolver(schema),
  });

  const { mutate: updateMeetupMutate, isError, isSuccess } = useMutation({
    mutationFn: updateMeetup,
    onSuccess: () => {
      console.log("Success");
      reset();
    },
    onError: () => {
      console.log("Error");
    },
  });

  const handleUpdateMeetup = (id: number, data: meetup) => {
    updateMeetupMutate(id, data);
  };

  return {
    handleSubmit,
    handleUpdateMeetup,
    register,
    errors,
    isSuccess,
    isError,
  };
};

export { useUpdateForm };
