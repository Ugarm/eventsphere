import React, {createContext, useState} from "react";

interface FilterContextType {
    isEvent: boolean,
    setIsEvent: React.Dispatch<React.SetStateAction<boolean>>
}

interface FilterContextProps {
    children: React.ReactNode;
}

const FilterContext = createContext<FilterContextType | undefined>(undefined);

const FilterProvider = ({children}: FilterContextProps) => {
    const [isEvent, setIsEvent] = useState<boolean>(true);

    return (
        <FilterContext.Provider value={{isEvent, setIsEvent}}>
            {children}
        </FilterContext.Provider>
    )
}

export {FilterProvider, FilterContext}