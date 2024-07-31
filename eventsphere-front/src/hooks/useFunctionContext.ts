import { useContext } from "react";
import { AuthentificationContext } from "../stores/AuthentificationProvider";
import {FilterContext} from "../components/meetups/stores/FilterProvider.tsx";

const useAuthentificationContext = () => {
  const context = useContext(AuthentificationContext);
  if (context === undefined) {
    throw new Error(
      "useAuthentificationUSerContext must be used within a AuthentificationUserProvider"
    );
  }
  return context;
};

const useFilterContext = () => {
  const context = useContext(FilterContext);
  if (context === undefined) {
    throw new Error(
        "useFilterContext must be used within a FilterProvider"
    );
  }
  return context;
};

export { useAuthentificationContext, useFilterContext };
