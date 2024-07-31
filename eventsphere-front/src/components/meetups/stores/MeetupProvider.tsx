import { createContext, useState } from "react";
import { meetup } from "../types/types";
import { instance } from "../../../axios/axios";

interface MeetupContextProps {
  children: React.ReactNode;
}

interface MeetupContextType {
  getAllMeetups: () => Promise<void>;
  getMeetup: (id: number) => Promise<void>;
  createMeetup: (meetup: meetup) => Promise<void>;
  updateMeetup: (id: number, meetup: meetup) => Promise<void>;
  deleteMeetup: (id: number) => Promise<void>;
  modalMeetup: boolean;
  setModalMeetup: (value: boolean) => void;
}

const meetupContext = createContext<MeetupContextType | undefined>(undefined);
const MeetupProvider = ({ children }: MeetupContextProps) => {
  const [modalMeetup, setModalMeetup] = useState<boolean>(false);
  const getAllMeetups = async () => {
    try {
      const response = await instance.get("/meetups");
      return response.data;
    } catch (error) {
      console.error(error);
    }
  };

  const getMeetup = async (id: number) => {
    try {
      const response = await instance.get(`/meetups/${id}`);
      return response.data;
    } catch (error) {
      console.error(error);
    }
  };

  const createMeetup = async (meetup: meetup) => {
    try {
      // const response = await instance.post("/meetups/create", meetup);
      // return response.data;
      console.log(meetup);
      
    } catch (error) {
      console.error(error);
    }
  };

  const updateMeetup = async (id: number, meetup: meetup) => {
    try {
      // const response = await instance.put(`/meetups/update/${id}`, meetup);
      // return response.data;
      console.log(id, meetup);
    } catch (error) {
      console.error(error);
    }
  };

  const deleteMeetup = async (id: number) => {
    try {
      const response = await instance.delete(`/meetups/delete/${id}`);
      return response.data;
    } catch (error) {
      console.error(error);
    }
  };

  return (
    <meetupContext.Provider
      value={{
        getAllMeetups,
        getMeetup,
        createMeetup,
        updateMeetup,
        deleteMeetup,
        modalMeetup,
        setModalMeetup,
      }}
    >
      {children}
    </meetupContext.Provider>
  );
};

export { MeetupProvider, meetupContext };
