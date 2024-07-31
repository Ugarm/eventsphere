import { createContext, useState } from "react";
import { meetup } from "../types/types";
import { instance } from "../../../axios/axios";

interface EventContextProps {
    children: React.ReactNode;
}

interface EventContextType {
    getAllEvents: () => Promise<void>;
    getEvent: (id: number) => Promise<void>;
    createEvent: (meetup: meetup) => Promise<void>;
    updateEvent: (id: number, meetup: meetup) => Promise<void>;
    deleteEvent: (id: number) => Promise<void>;
    modalEvent: boolean;
    setModalEvent: (value: boolean) => void;
}

const eventContext = createContext<EventContextType | undefined>(undefined);
const EventProvider = ({ children }: EventContextProps) => {
    const [modalEvent, setModalEvent] = useState<boolean>(false);
    const getAllEvents = async () => {
        try {
            const response = await instance.get("/events");
            return response.data;
        } catch (error) {
            console.error(error);
        }
    };

    const getEvent = async (id: number) => {
        try {
            const response = await instance.get(`/events/${id}`);
            return response.data;
        } catch (error) {
            console.error(error);
        }
    };

    const createEvent = async (event: event) => {
        try {
            // const response = await instance.post("/events/create", event);
            // return response.data;
            console.log(event);

        } catch (error) {
            console.error(error);
        }
    };

    const updateEvent = async (id: number, event: event) => {
        try {
            // const response = await instance.put(`/events/update/${id}`, event);
            // return response.data;
            console.log(id, event);
        } catch (error) {
            console.error(error);
        }
    };

    const deleteEvent = async (id: number) => {
        try {
            const response = await instance.delete(`/events/delete/${id}`);
            return response.data;
        } catch (error) {
            console.error(error);
        }
    };

    return (
        <eventContext.Provider
            value={{
                getAllEvents,
                getEvent,
                createEvent,
                updateEvent,
                deleteEvent,
                modalEvent,
                setModalEvent,
            }}
        >
            {children}
        </eventContext.Provider>
    );
};

export { EventProvider, eventContext };
