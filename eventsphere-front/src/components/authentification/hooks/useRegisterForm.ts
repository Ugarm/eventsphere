import { yupResolver } from "@hookform/resolvers/yup";
import * as yup from "yup";
import { registerUserData } from "../types/types";
import { useForm } from "react-hook-form";
import { useMutation } from "@tanstack/react-query";
import { useAuthentificationContext } from "../../../hooks/useFunctionContext";

const useRegisterForm = () => {
  const { signup } = useAuthentificationContext();

  const schema = yup.object({
    lastname: yup.string().required("Ce champs est requis"),
    firstname: yup.string(),
    nickname: yup.string(),
    address: yup.string(),
    address_two: yup.string(),
    city: yup.string(),
    postal_code: yup.string(),
    phone: yup.string(),
    email: yup.string().email().required("Ce champs est requis"),
    password: yup
      .string()
      .required("Ce champs est requis")
      .min(8, "Le mot de passe doit contenir au moins 8 caractères")
      .matches(
        /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])/,
        "Le mot de passe doit contenir au moins une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial"
      ),
    confirm_password: yup
      .string()
      .required("Ce champs est requis")
      .min(8, "Le mot de passe doit contenir au moins 8 caractères")
      .oneOf([yup.ref("password")], "Les mots de passe ne correspondent pas"),
  });

  const {
    handleSubmit,
    register,
    formState: { errors },
  } = useForm({
    resolver: yupResolver(schema),
  });

  const { mutate } = useMutation({
    mutationFn: signup,
   
  });

  const handleSignup = (data: registerUserData) => {
    mutate(data);
  };

  return {
    handleSubmit,
    register,
    signup,
    handleSignup,
    errors,

  };
};

export { useRegisterForm };
