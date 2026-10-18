--
-- PostgreSQL database dump
--



-- Dumped from database version 18.3
-- Dumped by pg_dump version 18.3

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: absensi; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.absensi (
    id bigint NOT NULL,
    latitude character varying(255) NOT NULL,
    longitude character varying(255) NOT NULL,
    address text NOT NULL,
    type_absen character varying(50) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    jadwal_residen_id bigint,
    residen_id bigint,
    dpjp_id bigint
);


ALTER TABLE public.absensi OWNER TO postgres;

--
-- Name: absensi_dpjp; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.absensi_dpjp (
    id bigint NOT NULL,
    dpjp_id bigint,
    jadwal_id bigint,
    latitude character varying(255) NOT NULL,
    longitude character varying(255) NOT NULL,
    address text NOT NULL,
    type_absen character varying(50) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.absensi_dpjp OWNER TO postgres;

--
-- Name: absensi_dpjp_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.absensi_dpjp_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.absensi_dpjp_id_seq OWNER TO postgres;

--
-- Name: absensi_dpjp_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.absensi_dpjp_id_seq OWNED BY public.absensi_dpjp.id;


--
-- Name: absensi_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.absensi_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.absensi_id_seq OWNER TO postgres;

--
-- Name: absensi_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.absensi_id_seq OWNED BY public.absensi.id;


--
-- Name: audit_logs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.audit_logs (
    id bigint NOT NULL,
    user_id bigint,
    activity character varying(255) NOT NULL,
    status_simrs character varying(255),
    ip_address character varying(50),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    residen_id bigint,
    dpjp_id bigint
);


ALTER TABLE public.audit_logs OWNER TO postgres;

--
-- Name: audit_logs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.audit_logs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.audit_logs_id_seq OWNER TO postgres;

--
-- Name: audit_logs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.audit_logs_id_seq OWNED BY public.audit_logs.id;


--
-- Name: cache; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cache (
    key character varying(255) NOT NULL,
    value text NOT NULL,
    expiration integer NOT NULL
);


ALTER TABLE public.cache OWNER TO postgres;

--
-- Name: cache_locks; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cache_locks (
    key character varying(255) NOT NULL,
    owner character varying(255) NOT NULL,
    expiration integer NOT NULL
);


ALTER TABLE public.cache_locks OWNER TO postgres;

--
-- Name: dpjps; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.dpjps (
    id bigint NOT NULL,
    fullname character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    username character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    id_identitas character varying(255) NOT NULL,
    role character varying(255) NOT NULL,
    status character varying(255) NOT NULL,
    photo character varying(255),
    semester character varying(255),
    nilai_akhir character varying(255),
    ket_nilai character varying(255),
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.dpjps OWNER TO postgres;

--
-- Name: dpjps_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.dpjps_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.dpjps_id_seq OWNER TO postgres;

--
-- Name: dpjps_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.dpjps_id_seq OWNED BY public.dpjps.id;


--
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.failed_jobs OWNER TO postgres;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.failed_jobs_id_seq OWNER TO postgres;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- Name: jadwal; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.jadwal (
    id bigint NOT NULL,
    day character varying(255) NOT NULL,
    start_time time(0) without time zone NOT NULL,
    end_time time(0) without time zone NOT NULL,
    keterangan text,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    dpjp_id bigint
);


ALTER TABLE public.jadwal OWNER TO postgres;

--
-- Name: jadwal_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.jadwal_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.jadwal_id_seq OWNER TO postgres;

--
-- Name: jadwal_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.jadwal_id_seq OWNED BY public.jadwal.id;


--
-- Name: jadwal_residen; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.jadwal_residen (
    id bigint NOT NULL,
    jadwal_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    residen_id bigint,
    dpjp_id bigint
);


ALTER TABLE public.jadwal_residen OWNER TO postgres;

--
-- Name: jadwal_residen_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.jadwal_residen_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.jadwal_residen_id_seq OWNER TO postgres;

--
-- Name: jadwal_residen_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.jadwal_residen_id_seq OWNED BY public.jadwal_residen.id;


--
-- Name: job_batches; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.job_batches (
    id character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    total_jobs integer NOT NULL,
    pending_jobs integer NOT NULL,
    failed_jobs integer NOT NULL,
    failed_job_ids text NOT NULL,
    options text,
    cancelled_at integer,
    created_at integer NOT NULL,
    finished_at integer
);


ALTER TABLE public.job_batches OWNER TO postgres;

--
-- Name: jobs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.jobs (
    id bigint NOT NULL,
    queue character varying(255) NOT NULL,
    payload text NOT NULL,
    attempts smallint NOT NULL,
    reserved_at integer,
    available_at integer NOT NULL,
    created_at integer NOT NULL
);


ALTER TABLE public.jobs OWNER TO postgres;

--
-- Name: jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.jobs_id_seq OWNER TO postgres;

--
-- Name: jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.jobs_id_seq OWNED BY public.jobs.id;


--
-- Name: krs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.krs (
    id bigint NOT NULL,
    user_id bigint,
    modul_id bigint,
    semester_ambil character varying(255) NOT NULL,
    status_krs character varying(255) NOT NULL,
    tanggal_isi timestamp(0) without time zone NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT krs_status_krs_check CHECK (((status_krs)::text = ANY ((ARRAY['Disetujui'::character varying, 'Ditolak'::character varying, 'Pending'::character varying])::text[])))
);


ALTER TABLE public.krs OWNER TO postgres;

--
-- Name: krs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.krs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.krs_id_seq OWNER TO postgres;

--
-- Name: krs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.krs_id_seq OWNED BY public.krs.id;


--
-- Name: krs_residen; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.krs_residen (
    id bigint NOT NULL,
    master_krs_id bigint NOT NULL,
    status character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    residen_id bigint
);


ALTER TABLE public.krs_residen OWNER TO postgres;

--
-- Name: krs_residen_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.krs_residen_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.krs_residen_id_seq OWNER TO postgres;

--
-- Name: krs_residen_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.krs_residen_id_seq OWNED BY public.krs_residen.id;


--
-- Name: master_krs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.master_krs (
    id bigint NOT NULL,
    kode_mk character varying(255) NOT NULL,
    nama_mk character varying(255) NOT NULL,
    semester integer NOT NULL,
    sks integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.master_krs OWNER TO postgres;

--
-- Name: master_krs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.master_krs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.master_krs_id_seq OWNER TO postgres;

--
-- Name: master_krs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.master_krs_id_seq OWNED BY public.master_krs.id;


--
-- Name: master_modul; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.master_modul (
    id bigint NOT NULL,
    kode_modul character varying(255) NOT NULL,
    nama_modul character varying(255) NOT NULL,
    semester integer NOT NULL,
    sks integer NOT NULL,
    kuota_tindakan integer,
    asa1 boolean,
    asa2 boolean,
    asa3 boolean,
    asa4 boolean,
    asa5 boolean,
    asa6 boolean,
    asa7 boolean,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.master_modul OWNER TO postgres;

--
-- Name: master_modul_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.master_modul_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.master_modul_id_seq OWNER TO postgres;

--
-- Name: master_modul_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.master_modul_id_seq OWNED BY public.master_modul.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.migrations_id_seq OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: modul_residen; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.modul_residen (
    id bigint NOT NULL,
    master_modul_id bigint NOT NULL,
    status character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    user_id bigint
);


ALTER TABLE public.modul_residen OWNER TO postgres;

--
-- Name: modul_residen_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.modul_residen_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.modul_residen_id_seq OWNER TO postgres;

--
-- Name: modul_residen_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.modul_residen_id_seq OWNED BY public.modul_residen.id;


--
-- Name: password_reset_tokens; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_reset_tokens OWNER TO postgres;

--
-- Name: residens; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.residens (
    id bigint NOT NULL,
    fullname character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    username character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    id_identitas character varying(255) NOT NULL,
    role character varying(255) NOT NULL,
    status character varying(255) NOT NULL,
    photo character varying(255),
    semester character varying(255),
    nilai_akhir character varying(255),
    ket_nilai character varying(255),
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.residens OWNER TO postgres;

--
-- Name: residens_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.residens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.residens_id_seq OWNER TO postgres;

--
-- Name: residens_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.residens_id_seq OWNED BY public.residens.id;


--
-- Name: sessions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sessions (
    id character varying(255) NOT NULL,
    user_id bigint,
    ip_address character varying(45),
    user_agent text,
    payload text NOT NULL,
    last_activity integer NOT NULL
);


ALTER TABLE public.sessions OWNER TO postgres;

--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    fullname character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    username character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    id_identitas character varying(255) NOT NULL,
    role character varying(255) NOT NULL,
    status character varying(255) NOT NULL,
    photo character varying(255),
    semester character varying(255),
    nilai_akhir character varying(255),
    ket_nilai character varying(255),
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.users_id_seq OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: absensi id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.absensi ALTER COLUMN id SET DEFAULT nextval('public.absensi_id_seq'::regclass);


--
-- Name: absensi_dpjp id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.absensi_dpjp ALTER COLUMN id SET DEFAULT nextval('public.absensi_dpjp_id_seq'::regclass);


--
-- Name: audit_logs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.audit_logs ALTER COLUMN id SET DEFAULT nextval('public.audit_logs_id_seq'::regclass);


--
-- Name: dpjps id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dpjps ALTER COLUMN id SET DEFAULT nextval('public.dpjps_id_seq'::regclass);


--
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- Name: jadwal id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jadwal ALTER COLUMN id SET DEFAULT nextval('public.jadwal_id_seq'::regclass);


--
-- Name: jadwal_residen id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jadwal_residen ALTER COLUMN id SET DEFAULT nextval('public.jadwal_residen_id_seq'::regclass);


--
-- Name: jobs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jobs ALTER COLUMN id SET DEFAULT nextval('public.jobs_id_seq'::regclass);


--
-- Name: krs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.krs ALTER COLUMN id SET DEFAULT nextval('public.krs_id_seq'::regclass);


--
-- Name: krs_residen id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.krs_residen ALTER COLUMN id SET DEFAULT nextval('public.krs_residen_id_seq'::regclass);


--
-- Name: master_krs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.master_krs ALTER COLUMN id SET DEFAULT nextval('public.master_krs_id_seq'::regclass);


--
-- Name: master_modul id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.master_modul ALTER COLUMN id SET DEFAULT nextval('public.master_modul_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: modul_residen id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.modul_residen ALTER COLUMN id SET DEFAULT nextval('public.modul_residen_id_seq'::regclass);


--
-- Name: residens id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.residens ALTER COLUMN id SET DEFAULT nextval('public.residens_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: absensi; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: absensi_dpjp; Type: TABLE DATA; Schema: public; Owner: postgres
--


--
-- Data for Name: audit_logs; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: cache; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cache (key, value, expiration) FROM stdin;
\.


--
-- Data for Name: cache_locks; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cache_locks (key, owner, expiration) FROM stdin;
\.


--
-- Data for Name: dpjps; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.dpjps (id, fullname, email, username, password, id_identitas, role, status, photo, semester, nilai_akhir, ket_nilai, remember_token, created_at, updated_at) FROM stdin;
1	Dr Khoiron	khoiron@gmail.com	dpjp	$2y$12$26rYqtcPYkaUVEoV/g7xk.D5yemLbAl2RMQ8F7iVXgrOMHKbmjKlS	8899121	dpjp	Aktif	\N	\N	\N	\N	\N	2026-08-17 16:05:01	2026-08-17 21:41:04
\.


--
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
\.


--
-- Data for Name: jadwal; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.jadwal (id, day, start_time, end_time, keterangan, created_at, updated_at, dpjp_id) FROM stdin;
9	Monday	17:21:00	20:21:00	\N	2026-08-17 16:21:21	2026-08-17 16:21:21	1
\.


--
-- Data for Name: jadwal_residen; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.jadwal_residen (id, jadwal_id, created_at, updated_at, residen_id, dpjp_id) FROM stdin;
4	9	2026-08-17 16:32:13	2026-08-17 16:32:13	1	1
6	9	2026-08-17 16:57:24	2026-08-17 16:57:24	2	1
\.


--
-- Data for Name: job_batches; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.job_batches (id, name, total_jobs, pending_jobs, failed_jobs, failed_job_ids, options, cancelled_at, created_at, finished_at) FROM stdin;
\.


--
-- Data for Name: jobs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.jobs (id, queue, payload, attempts, reserved_at, available_at, created_at) FROM stdin;
\.


--
-- Data for Name: krs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.krs (id, user_id, modul_id, semester_ambil, status_krs, tanggal_isi, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: krs_residen; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.krs_residen (id, master_krs_id, status, created_at, updated_at, residen_id) FROM stdin;
4	3	Pending	2026-08-17 19:51:36	2026-08-17 19:51:36	1
3	2	Disetujui	2026-08-17 19:51:21	2026-08-17 19:51:21	1
\.


--
-- Data for Name: master_krs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.master_krs (id, kode_mk, nama_mk, semester, sks, created_at, updated_at) FROM stdin;
2	MKDU	Matematika	1	2	2026-08-16 22:21:06	2026-08-16 22:21:06
3	KH-01	Bahasa Indonesia	3	3	2026-08-17 13:05:30	2026-08-17 13:05:30
\.


--
-- Data for Name: master_modul; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.master_modul (id, kode_modul, nama_modul, semester, sks, kuota_tindakan, asa1, asa2, asa3, asa4, asa5, asa6, asa7, created_at, updated_at) FROM stdin;
3	cscasc111	Matematika	3	1	\N	\N	\N	\N	\N	\N	\N	\N	2026-08-16 11:09:38	2026-08-16 11:23:58
6	AN-001	Bahasa Indonesia	2	3	0	t	f	t	f	f	f	f	2026-08-16 22:48:21	2026-08-16 22:48:21
5	csa-01	Bahasa Inggris	1	2	0	t	f	t	f	t	f	f	2026-08-16 11:21:26	2026-08-16 22:48:44
\.


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.migrations (id, migration, batch) FROM stdin;
1	0001_01_01_000000_create_users_table	1
2	0001_01_01_000001_create_cache_table	1
3	0001_01_01_000002_create_jobs_table	1
4	2026_08_15_081910_create_audit_logs_table	1
5	2026_08_15_082105_create_absensis_table	1
6	2026_08_15_082249_create_jadwals_table	1
7	2026_08_15_082416_create_krs_table	1
8	2026_08_15_082618_create_master_krs_table	1
9	2026_08_15_082737_create_master_moduls_table	1
10	2026_08_15_132706_add_indexes_to_audit_logs_table	2
11	2026_08_15_132807_add_indexes_to_users_table	2
12	2026_08_15_133412_add_indexes_to_jadwals_table	2
13	2026_08_15_133739_add_indexes_to_master_krs_table	2
14	2026_08_15_135751_add_indexes_to_master_modul_table	2
15	2026_08_15_140616_add_foreign_key_to_audit_logs_table	2
16	2026_08_15_140742_add_foreign_key_to_absensis_table	2
17	2026_08_15_140822_add_foreign_key_to_jadwals_table	2
18	2026_08_15_141154_add_foreign_key_to_krs_table	2
19	2026_08_15_154450_drop_fullname_standard_index_from_users_table	3
20	2026_08_15_154852_drop_fullname_standard_index_from_jadwals_table	3
21	2026_08_15_155006_drop_fullname_standard_index_from_master_krs_table	3
22	2026_08_15_155049_drop_fullname_standard_index_from_master_modul_table	3
23	2026_08_15_155332_add_lowercase_indexes_to_users_table	4
24	2026_08_15_155933_add_lowercase_indexes_to_jadwals_table	4
25	2026_08_15_160109_add_lowercase_indexes_to_master_krs_table	4
26	2026_08_15_160239_add_lowercase_indexes_to_master_modul_table	4
27	2026_08_16_103024_change_field_column_from_master_moduls_table	5
28	2026_08_16_110117_change_to_nullable_field_column_from_master_moduls_table	6
29	2026_08_16_110744_change_to_nullable_default_field_column_from_master_moduls_table	7
30	2026_08_16_122932_create_jadwal_residens_table	8
31	2026_08_17_001841_add_field_to_absensis_table	9
32	2026_08_17_010425_change_field_to_absensis_table	10
33	2026_08_17_115151_create_modul_residens_table	11
34	2026_08_17_120340_add_field_to_modul_residens_table	12
35	2026_08_17_125341_create_krs_residens_table	13
36	2026_08_17_133254_create_residens_table	14
37	2026_08_17_133304_create_dpjps_table	14
38	2026_08_17_150850_change_field_reference_to_modul_residens_table	15
39	2026_08_17_151318_change_field_reference_to_krs_residens_table	16
40	2026_08_17_151905_add_field_reference_to_audit_logs_table	17
41	2026_08_17_154841_change_field_reference_to_jadwals_table	18
42	2026_08_17_162439_change_field_reference_to_jadwal_residens_table	19
43	2026_08_17_172207_drop_field_to_absensis_table	20
44	2026_08_17_194658_drop_field_to_krs_residens_table	21
45	2026_08_17_220704_create_absensi_dpjps_table	22
\.


--
-- Data for Name: modul_residen; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.modul_residen (id, master_modul_id, status, created_at, updated_at, user_id) FROM stdin;
2	3	Pending	2026-08-17 12:43:18	2026-08-17 12:43:18	\N
3	6	Pending	2026-08-17 12:45:49	2026-08-17 12:45:49	\N
\.


--
-- Data for Name: password_reset_tokens; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.password_reset_tokens (email, token, created_at) FROM stdin;
faizinfifaridillah92@gmail.com	$2y$12$CWnUPNS1/yZOAkG5p59Lu.Ki4Ceaar4EusHScPvsIc3TemNRSkQNK	2026-08-17 23:53:17
\.


--
-- Data for Name: residens; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.residens (id, fullname, email, username, password, id_identitas, role, status, photo, semester, nilai_akhir, ket_nilai, remember_token, created_at, updated_at) FROM stdin;
1	Dr Budi Santoso	budi@gmail.com	residen1	$2y$12$KjxkxGnBTAGz1mZn7zHWkOwZP/U7OIGWaKq1DDGRn3pRPj6VyzG6C	0123211	residen	Aktif	\N	\N	\N	\N	\N	2026-08-17 14:07:25	2026-08-17 14:45:24
2	Dr Lukman Hakim	projectfaizin@gmail.com	residen2	$2y$12$CwZw4baa4oagM/Crgg1PaedCWu65aUEI6slNm7BA5SEmvNd2ACMiy	1234545	residen	Aktif	\N	\N	\N	\N	\N	2026-08-17 14:49:02	2026-08-18 00:16:43
\.


--
-- Data for Name: sessions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) FROM stdin;
T5T9mu14PocEjF0i3qjQd74Jv8GUriaJxPs2OgIx	\N	127.0.0.1	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36	YTo0OntzOjY6Il90b2tlbiI7czo0MDoielg5RlpxdzRrMHRHZmFocFZHZURKd3U2Zm1odGNSNTlMZ0FwZ1o1QSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoxMjoiY2FwdGNoYV9jb2RlIjtpOjYwNDA7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9mb3Jnb3QtcGFzc3dvcmQiO3M6NToicm91dGUiO3M6MTY6InBhc3N3b3JkLnJlcXVlc3QiO319	1786985613
icp6WOBRYUBZiZpCOK0jifCSrBe9Hwe1EZZHHmcb	\N	127.0.0.1	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36	YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZjRZTWpIUU1rZUpKMG9PRjJOblJGcDZOTEJXdVVpd3FlSWlrY21pMiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MTI6ImNhcHRjaGFfY29kZSI7aTo4MDUzO30=	1786987728
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, fullname, email, username, password, id_identitas, role, status, photo, semester, nilai_akhir, ket_nilai, remember_token, created_at, updated_at) FROM stdin;
3	Faizin	faizin@gmal.com	admin	$2y$12$4ScEVMfxDCRHS9iMl6rK8u8UsnOtlyGpWZqzsHX8Txsz6RK5xCvpS	0333223333	admin	Aktif	\N	\N	\N	\N	\N	2026-08-15 09:17:07	2026-08-15 09:17:07
\.


--
-- Name: absensi_dpjp_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.absensi_dpjp_id_seq', 2, true);


--
-- Name: absensi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.absensi_id_seq', 10, true);


--
-- Name: audit_logs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.audit_logs_id_seq', 40, true);


--
-- Name: dpjps_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.dpjps_id_seq', 1, true);


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- Name: jadwal_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.jadwal_id_seq', 9, true);


--
-- Name: jadwal_residen_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.jadwal_residen_id_seq', 6, true);


--
-- Name: jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.jobs_id_seq', 1, false);


--
-- Name: krs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.krs_id_seq', 1, false);


--
-- Name: krs_residen_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.krs_residen_id_seq', 4, true);


--
-- Name: master_krs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.master_krs_id_seq', 3, true);


--
-- Name: master_modul_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.master_modul_id_seq', 6, true);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.migrations_id_seq', 45, true);


--
-- Name: modul_residen_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.modul_residen_id_seq', 3, true);


--
-- Name: residens_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.residens_id_seq', 2, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 10, true);


--
-- Name: absensi_dpjp absensi_dpjp_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.absensi_dpjp
    ADD CONSTRAINT absensi_dpjp_pkey PRIMARY KEY (id);


--
-- Name: absensi absensi_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.absensi
    ADD CONSTRAINT absensi_pkey PRIMARY KEY (id);


--
-- Name: audit_logs audit_logs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.audit_logs
    ADD CONSTRAINT audit_logs_pkey PRIMARY KEY (id);


--
-- Name: cache_locks cache_locks_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cache_locks
    ADD CONSTRAINT cache_locks_pkey PRIMARY KEY (key);


--
-- Name: cache cache_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cache
    ADD CONSTRAINT cache_pkey PRIMARY KEY (key);


--
-- Name: dpjps dpjps_email_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dpjps
    ADD CONSTRAINT dpjps_email_unique UNIQUE (email);


--
-- Name: dpjps dpjps_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dpjps
    ADD CONSTRAINT dpjps_pkey PRIMARY KEY (id);


--
-- Name: dpjps dpjps_username_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dpjps
    ADD CONSTRAINT dpjps_username_unique UNIQUE (username);


--
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- Name: jadwal jadwal_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jadwal
    ADD CONSTRAINT jadwal_pkey PRIMARY KEY (id);


--
-- Name: jadwal_residen jadwal_residen_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jadwal_residen
    ADD CONSTRAINT jadwal_residen_pkey PRIMARY KEY (id);


--
-- Name: job_batches job_batches_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.job_batches
    ADD CONSTRAINT job_batches_pkey PRIMARY KEY (id);


--
-- Name: jobs jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jobs
    ADD CONSTRAINT jobs_pkey PRIMARY KEY (id);


--
-- Name: krs krs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.krs
    ADD CONSTRAINT krs_pkey PRIMARY KEY (id);


--
-- Name: krs_residen krs_residen_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.krs_residen
    ADD CONSTRAINT krs_residen_pkey PRIMARY KEY (id);


--
-- Name: master_krs master_krs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.master_krs
    ADD CONSTRAINT master_krs_pkey PRIMARY KEY (id);


--
-- Name: master_modul master_modul_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.master_modul
    ADD CONSTRAINT master_modul_pkey PRIMARY KEY (id);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: modul_residen modul_residen_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.modul_residen
    ADD CONSTRAINT modul_residen_pkey PRIMARY KEY (id);


--
-- Name: password_reset_tokens password_reset_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);


--
-- Name: residens residens_email_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.residens
    ADD CONSTRAINT residens_email_unique UNIQUE (email);


--
-- Name: residens residens_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.residens
    ADD CONSTRAINT residens_pkey PRIMARY KEY (id);


--
-- Name: residens residens_username_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.residens
    ADD CONSTRAINT residens_username_unique UNIQUE (username);


--
-- Name: sessions sessions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: users users_username_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_username_unique UNIQUE (username);


--
-- Name: audit_logs_created_at_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX audit_logs_created_at_index ON public.audit_logs USING btree (created_at);


--
-- Name: audit_logs_user_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX audit_logs_user_id_index ON public.audit_logs USING btree (user_id);


--
-- Name: cache_expiration_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX cache_expiration_index ON public.cache USING btree (expiration);


--
-- Name: cache_locks_expiration_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX cache_locks_expiration_index ON public.cache_locks USING btree (expiration);


--
-- Name: jadwal_day_lower_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX jadwal_day_lower_index ON public.jadwal USING btree (lower((day)::text));


--
-- Name: jobs_queue_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX jobs_queue_index ON public.jobs USING btree (queue);


--
-- Name: krs_modul_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX krs_modul_id_index ON public.krs USING btree (modul_id);


--
-- Name: krs_user_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX krs_user_id_index ON public.krs USING btree (user_id);


--
-- Name: master_krs_kode_mk_lower_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX master_krs_kode_mk_lower_index ON public.master_krs USING btree (lower((kode_mk)::text));


--
-- Name: master_krs_nama_mk_lower_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX master_krs_nama_mk_lower_index ON public.master_krs USING btree (lower((nama_mk)::text));


--
-- Name: master_modul_kode_modul_lower_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX master_modul_kode_modul_lower_index ON public.master_modul USING btree (lower((kode_modul)::text));


--
-- Name: master_modul_nama_modul_lower_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX master_modul_nama_modul_lower_index ON public.master_modul USING btree (lower((nama_modul)::text));


--
-- Name: sessions_last_activity_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);


--
-- Name: sessions_user_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);


--
-- Name: users_fullname_lower_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX users_fullname_lower_index ON public.users USING btree (lower((fullname)::text));


--
-- Name: users_role_lower_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX users_role_lower_index ON public.users USING btree (lower((role)::text));


--
-- Name: users_username_lower_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX users_username_lower_index ON public.users USING btree (lower((username)::text));


--
-- Name: absensi_dpjp absensi_dpjp_dpjp_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.absensi_dpjp
    ADD CONSTRAINT absensi_dpjp_dpjp_id_foreign FOREIGN KEY (dpjp_id) REFERENCES public.dpjps(id) ON DELETE SET NULL;


--
-- Name: absensi absensi_dpjp_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.absensi
    ADD CONSTRAINT absensi_dpjp_id_foreign FOREIGN KEY (dpjp_id) REFERENCES public.dpjps(id) ON DELETE SET NULL;


--
-- Name: absensi_dpjp absensi_dpjp_jadwal_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.absensi_dpjp
    ADD CONSTRAINT absensi_dpjp_jadwal_id_foreign FOREIGN KEY (jadwal_id) REFERENCES public.jadwal(id) ON DELETE SET NULL;


--
-- Name: absensi absensi_jadwal_residen_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.absensi
    ADD CONSTRAINT absensi_jadwal_residen_id_foreign FOREIGN KEY (jadwal_residen_id) REFERENCES public.jadwal_residen(id) ON DELETE SET NULL;


--
-- Name: absensi absensi_residen_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.absensi
    ADD CONSTRAINT absensi_residen_id_foreign FOREIGN KEY (residen_id) REFERENCES public.residens(id) ON DELETE SET NULL;


--
-- Name: audit_logs audit_logs_dpjp_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.audit_logs
    ADD CONSTRAINT audit_logs_dpjp_id_foreign FOREIGN KEY (dpjp_id) REFERENCES public.dpjps(id) ON DELETE SET NULL;


--
-- Name: audit_logs audit_logs_residen_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.audit_logs
    ADD CONSTRAINT audit_logs_residen_id_foreign FOREIGN KEY (residen_id) REFERENCES public.residens(id) ON DELETE SET NULL;


--
-- Name: audit_logs audit_logs_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.audit_logs
    ADD CONSTRAINT audit_logs_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE SET NULL;


--
-- Name: jadwal jadwal_dpjp_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jadwal
    ADD CONSTRAINT jadwal_dpjp_id_foreign FOREIGN KEY (dpjp_id) REFERENCES public.dpjps(id) ON DELETE SET NULL;


--
-- Name: jadwal_residen jadwal_residen_dpjp_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jadwal_residen
    ADD CONSTRAINT jadwal_residen_dpjp_id_foreign FOREIGN KEY (dpjp_id) REFERENCES public.dpjps(id) ON DELETE SET NULL;


--
-- Name: jadwal_residen jadwal_residen_jadwal_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jadwal_residen
    ADD CONSTRAINT jadwal_residen_jadwal_id_foreign FOREIGN KEY (jadwal_id) REFERENCES public.jadwal(id) ON DELETE CASCADE;


--
-- Name: jadwal_residen jadwal_residen_residen_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jadwal_residen
    ADD CONSTRAINT jadwal_residen_residen_id_foreign FOREIGN KEY (residen_id) REFERENCES public.residens(id) ON DELETE SET NULL;


--
-- Name: krs krs_modul_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.krs
    ADD CONSTRAINT krs_modul_id_foreign FOREIGN KEY (modul_id) REFERENCES public.master_modul(id) ON DELETE SET NULL;


--
-- Name: krs_residen krs_residen_master_krs_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.krs_residen
    ADD CONSTRAINT krs_residen_master_krs_id_foreign FOREIGN KEY (master_krs_id) REFERENCES public.master_krs(id);


--
-- Name: krs_residen krs_residen_residen_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.krs_residen
    ADD CONSTRAINT krs_residen_residen_id_foreign FOREIGN KEY (residen_id) REFERENCES public.residens(id) ON DELETE SET NULL;


--
-- Name: krs krs_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.krs
    ADD CONSTRAINT krs_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE SET NULL;


--
-- Name: modul_residen modul_residen_master_modul_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.modul_residen
    ADD CONSTRAINT modul_residen_master_modul_id_foreign FOREIGN KEY (master_modul_id) REFERENCES public.master_modul(id);


--
-- Name: modul_residen modul_residen_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.modul_residen
    ADD CONSTRAINT modul_residen_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE SET NULL;


--
-- PostgreSQL database dump complete
--


