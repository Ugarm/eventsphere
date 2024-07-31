import { yupResolver } from "@hookform/resolvers/yup";
import * as yup from "yup";
import { useForm } from "react-hook-form";
import { useMutation } from "@tanstack/react-query";
import { loginUserData } from "../types/types";
import { useAuthentificationContext } from "../../../hooks/useFunctionContext";

const useLoginForm = () => {
  const { login } = useAuthentificationContext();

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
  } = useForm({
    resolver: yupResolver(schema),
  });

  const { mutate } = useMutation({
    mutationFn: login,

  });

  const handleLogin = (data: loginUserData) => {
    mutate(data);
  };

  return {
    handleSubmit,
    handleLogin,
    register,
    errors,
  };
};

export { useLoginForm };
