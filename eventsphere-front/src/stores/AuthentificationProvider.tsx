/* eslint-disable @typescript-eslint/no-explicit-any */
import { createContext, useState } from "react";
import { instance } from "../axios/axios";
import { registerUserData, loginUserData, registerOrganismData, loginOrganismData } from "../components/authentification/types/types";
import { notify } from "../components/common/notification/Notification";
import { useForm } from "react-hook-form";

interface AuthentificationContextProps {
  children: React.ReactNode;
}

interface AuthentificationContextType {
  signup: (data: registerUserData) => Promise<void>;
  login: (data: loginUserData) => Promise<void>;
  logout: () => Promise<void>;
  signupOrganism: (data: registerOrganismData) => Promise<void>;
  loginOrganism: (data: loginOrganismData) => Promise<void>;
  isAuthentificated: {authenticated: boolean, user: any};
  setIsAuthentificated: React.Dispatch<React.SetStateAction<{authenticated: boolean, user: any}>>;
}

const AuthentificationContext = createContext<
  AuthentificationContextType | undefined
>(undefined);
const AuthentificationProvider = ({
  children,
}: AuthentificationContextProps) => {
  const { reset } = useForm();
  const [isAuthentificated, setIsAuthentificated] = useState<{authenticated: boolean, user: any}>({
    authenticated: false,
    user: null,
  });
  const token_name = import.meta.env.VITE_AUTH_TOKEN_NAME

  const signup = async (data: registerUserData) => {
    try {
      const response = await instance.post("/register", data);
      notify(response?.data?.message, "success");
      reset()
      return response.data;
    } catch (error: any) {
      return notify(error.message, "error");
    }
  };

  const login = async (data: loginUserData) => {
    try {
      const response = await instance.post("/login", data);
      setIsAuthentificated(prevState => ({...prevState, authenticated: true, user: response?.data?.user}));
      localStorage.setItem(token_name, response?.headers?.authorization);
      notify(response?.data?.message, "success");
      return response?.data;
    } catch (error: any) {
      return notify(error.message, "error");
    }
  };

  const logout = async () => {
    try {
      const response = await instance.post("/logout");
      setIsAuthentificated(prevState => ({...prevState, authenticated: false, user: null}));
      localStorage.removeItem(token_name);
      notify(response?.data?.message, "success");
      return response.data;
    } catch (error: any) {
      return notify(error.message, "error");
    }
  };


  const signupOrganism = async (data: registerOrganismData) => {
    try {
      const response = await instance.post("/organism/register", data);
      return response.data;
    } catch (error: any) {
      return error.message;
    }
  }

  const loginOrganism = async (data: loginOrganismData) => {
    try {
      const response = await instance.post("/organism/login", data);
      setIsAuthentificated(prevState => ({...prevState, authenticated: true, user: response?.data?.user}));
      localStorage.setItem(token_name, response?.headers?.authorization);
      return response?.data;
    } catch (error: any) {
      return error.message;
    }
  }


  return (
    <AuthentificationContext.Provider
      value={{
        signup,
        login,
        logout,
        signupOrganism,
        loginOrganism,
        isAuthentificated,
        setIsAuthentificated,
      }}
    >
      {children}
    </AuthentificationContext.Provider>
  );
};

export { AuthentificationProvider, AuthentificationContext };
