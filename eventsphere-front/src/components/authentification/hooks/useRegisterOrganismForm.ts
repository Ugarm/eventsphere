import { yupResolver } from "@hookform/resolvers/yup";
import * as yup from "yup";
import { useForm } from "react-hook-form";
import { useMutation } from "@tanstack/react-query";
import { useAuthentificationContext } from "../../../hooks/useFunctionContext";
import { notify } from "../../common/notification/Notification";
import { registerOrganismData } from "../types/types";

const useRegisterOrganismForm = () => {
  const { signupOrganism } = useAuthentificationContext();

  const schema = yup.object({
    
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
    mutationFn: signupOrganism,
    onSuccess: () => {
      notify("Inscription réussie", "success");
      reset();
    },
    onError: (e) => {
      notify(e.message, "error");
    },
  });

  const handleSignupOrganism = (data: registerOrganismData) => {
    mutate(data);
  };

  return {
    handleSubmit,
    register,
    handleSignupOrganism,
    errors,
    isSuccess,
    isError,
  };
};

export { useRegisterOrganismForm };
