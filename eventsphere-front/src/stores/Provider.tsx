/* eslint-disable react-refresh/only-export-components */
import { createContext } from "react";
import { AuthentificationProvider } from "./AuthentificationProvider";
import { MeetupProvider } from "../components/meetups/stores/MeetupProvider";
import {FilterProvider} from "../components/meetups/stores/FilterProvider.tsx";
import {EventProvider} from "../components/meetups/stores/EventProvider.tsx";

interface ProviderContextType {}

interface ProviderProps {
  children: React.ReactNode;
}

const providerContext = createContext<ProviderContextType | undefined>(
  undefined
);
const Provider = (props: ProviderProps) => {
  const { children } = props;
  return (
    <AuthentificationProvider>
        <FilterProvider>
            <EventProvider>
                <MeetupProvider>
                    <providerContext.Provider value={{}}>
                        {children}
                    </providerContext.Provider>
                </MeetupProvider>
            </EventProvider>
        </FilterProvider>
    </AuthentificationProvider>
  );
};

export { Provider, providerContext };
