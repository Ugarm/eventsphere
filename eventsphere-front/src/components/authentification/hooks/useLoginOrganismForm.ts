import { notify } from "../../common/notification/Notification";
import { loginOrganismData } from "../types/types";
import { yupResolver } from "@hookform/resolvers/yup";
import * as yup from "yup";
import { useForm } from "react-hook-form";
import { useMutation } from "@tanstack/react-query";
import { useAuthentificationContext } from "../../../hooks/useFunctionContext";

const useLoginOrganismForm = () => {
  const { loginOrganism } = useAuthentificationContext();

  const schema = yup.object().shape({
    email: yup.string().email("Email invalide").required("Ce champ est requis"),
    password: yup
      .string()
      .required("Ce champ est requis")
      .min(8, "Le mot de passe doit avoir au moins 8 caractères"),
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
    mutationFn: loginOrganism,
    onSuccess: () => {
      notify("Connexion réussie", "success");
      reset();
    },
    onError: (e) => {
      notify(e.message, "error");
    },
  });

  const handleLoginOrganism = (data: loginOrganismData) => {
    mutate(data);
  };

  return {
    handleSubmit,
    handleLoginOrganism,
    register,
    errors,
    isSuccess,
    isError,
  };
};

export { useLoginOrganismForm };
