import { createContext } from "react";
import { loginUserData, registerUserData } from "../../types/types";
import { instance } from "../../../../../axios/axios";

interface AuthentificationUserContextProps {
  children: React.ReactNode;
}

interface AuthentificationUserContextType {
  signup: (data: registerUserData) => Promise<void>;
  login: (data: loginUserData) => Promise<void>;
  logout: () => Promise<void>;
}

const AuthentificationUserContext = createContext<
  AuthentificationUserContextType | undefined
>(undefined);
const AuthentificationUserProvider = ({
  children,
}: AuthentificationUserContextProps) => {
  const signup = async (data: registerUserData) => {
    try {
      const response = await instance.post("/register", data);
      return response.data;
    } catch (error) {
      console.log(error);
    }
  };

  const login = async (data: loginUserData) => {
    try {
      const response = await instance.post("http://localhost:8000/login", data);
      return response.data;
    } catch (error) {
      console.log(error);
    }
  };

  const logout = async () => {
    try {
      // const response = await instance.post("/logout");
      // return response.data;
      console.log("logout");
    } catch (error) {
      console.log(error);
    }
  };

  return (
    <AuthentificationUserContext.Provider
      value={{
        signup,
        login,
        logout,
      }}
    >
      {children}
    </AuthentificationUserContext.Provider>
  );
};

export { AuthentificationUserProvider, AuthentificationUserContext };
