USE [master]
GO
/****** Object:  Database [OnlinePortalPoslova]    Script Date: 7/27/2023 6:36:07 PM ******/
CREATE DATABASE [OnlinePortalPoslova] ON  PRIMARY 
( NAME = N'OnlinePortalPoslova', FILENAME = N'c:\Program Files\Microsoft SQL Server\MSSQL10.SQLEXPRESS\MSSQL\DATA\OnlinePortalPoslova.mdf' , SIZE = 2048KB , MAXSIZE = UNLIMITED, FILEGROWTH = 1024KB )
 LOG ON 
( NAME = N'OnlinePortalPoslova_log', FILENAME = N'c:\Program Files\Microsoft SQL Server\MSSQL10.SQLEXPRESS\MSSQL\DATA\OnlinePortalPoslova_log.ldf' , SIZE = 1024KB , MAXSIZE = 2048GB , FILEGROWTH = 10%)
GO
ALTER DATABASE [OnlinePortalPoslova] SET COMPATIBILITY_LEVEL = 100
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [OnlinePortalPoslova].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [OnlinePortalPoslova] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [OnlinePortalPoslova] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [OnlinePortalPoslova] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [OnlinePortalPoslova] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [OnlinePortalPoslova] SET ARITHABORT OFF 
GO
ALTER DATABASE [OnlinePortalPoslova] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [OnlinePortalPoslova] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [OnlinePortalPoslova] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [OnlinePortalPoslova] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [OnlinePortalPoslova] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [OnlinePortalPoslova] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [OnlinePortalPoslova] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [OnlinePortalPoslova] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [OnlinePortalPoslova] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [OnlinePortalPoslova] SET  DISABLE_BROKER 
GO
ALTER DATABASE [OnlinePortalPoslova] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [OnlinePortalPoslova] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [OnlinePortalPoslova] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [OnlinePortalPoslova] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [OnlinePortalPoslova] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [OnlinePortalPoslova] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [OnlinePortalPoslova] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [OnlinePortalPoslova] SET RECOVERY SIMPLE 
GO
ALTER DATABASE [OnlinePortalPoslova] SET  MULTI_USER 
GO
ALTER DATABASE [OnlinePortalPoslova] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [OnlinePortalPoslova] SET DB_CHAINING OFF 
GO
USE [OnlinePortalPoslova]
GO
/****** Object:  Table [dbo].[EMPLOYER]    Script Date: 7/27/2023 6:36:07 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[EMPLOYER](
	[EmployerID] [int] NOT NULL,
	[ImeKompanije] [nvarchar](30) NOT NULL,
	[recruiter] [nvarchar](30) NOT NULL,
	[grad] [nvarchar](30) NOT NULL,
	[adresa] [nvarchar](50) NOT NULL,
	[emailPoslodavac] [nvarchar](50) NOT NULL,
	[telefonPoslodavac] [nvarchar](50) NOT NULL,
	[opisPoslodavac] [nvarchar](1000) NOT NULL,
	[lozinka] [nvarchar](50) NULL,
PRIMARY KEY CLUSTERED 
(
	[EmployerID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[KORISNIK]    Script Date: 7/27/2023 6:36:07 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[KORISNIK](
	[idKorisnik] [int] IDENTITY(1,1) NOT NULL,
	[ime] [nvarchar](30) NULL,
	[prezime] [nvarchar](30) NULL,
	[lozinka] [nvarchar](30) NULL,
	[iskustvo] [nvarchar](30) NULL,
	[diploma] [nvarchar](30) NULL,
	[kontaktTelefon] [nvarchar](30) NULL,
	[emailKorisnik] [nvarchar](50) NULL,
PRIMARY KEY CLUSTERED 
(
	[idKorisnik] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[korisnik_history]    Script Date: 7/27/2023 6:36:07 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[korisnik_history](
	[idKorisnik] [int] NOT NULL,
	[ime] [nvarchar](30) NOT NULL,
	[prezime] [nvarchar](30) NOT NULL,
	[lozinka] [nvarchar](50) NOT NULL,
	[iskustvo] [nvarchar](50) NOT NULL,
	[diploma] [nvarchar](30) NOT NULL,
	[kontaktTelefon] [nvarchar](20) NOT NULL,
	[emailKorisnik] [nvarchar](30) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[idKorisnik] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[POSAO]    Script Date: 7/27/2023 6:36:07 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[POSAO](
	[IdPosao] [int] IDENTITY(1,1) NOT NULL,
	[EmployerID] [int] NOT NULL,
	[naslov] [nvarchar](80) NOT NULL,
	[zahtevi] [nvarchar](1000) NOT NULL,
	[lokacija] [nvarchar](30) NOT NULL,
	[datumPostavljanja] [date] NOT NULL,
	[datumKraja] [date] NOT NULL,
	[opisPosla] [nvarchar](1000) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[IdPosao] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[posao_history]    Script Date: 7/27/2023 6:36:07 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[posao_history](
	[idposao] [int] NOT NULL,
	[EmployerID] [int] NOT NULL,
	[naslov] [nvarchar](80) NOT NULL,
	[zahtevi] [nvarchar](1000) NOT NULL,
	[lokacija] [nvarchar](30) NOT NULL,
	[datumPostavljanja] [date] NOT NULL,
	[datumKraja] [date] NOT NULL,
	[opisPosla] [nvarchar](1000) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[idposao] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[PRIJAVA]    Script Date: 7/27/2023 6:36:07 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[PRIJAVA](
	[idPrijava] [int] NOT NULL,
	[idKorisnik] [int] NOT NULL,
	[IdPosao] [int] NOT NULL,
	[datumPrijave] [date] NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[idPrijava] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[REKLAMIRANJE]    Script Date: 7/27/2023 6:36:07 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[REKLAMIRANJE](
	[IdReklama] [int] NOT NULL,
	[EmployerID] [int] NOT NULL,
	[pocetakTrajanja] [date] NOT NULL,
	[krajTrajanja] [date] NOT NULL,
	[cena] [int] NOT NULL,
	[opisReklame] [nvarchar](1000) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[IdReklama] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[reklamiranje_history]    Script Date: 7/27/2023 6:36:07 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[reklamiranje_history](
	[idreklama] [int] NOT NULL,
	[employerid] [int] NOT NULL,
	[pocetakTrajanja] [date] NOT NULL,
	[krajTrajanja] [date] NOT NULL,
	[cena] [int] NOT NULL,
	[opisReklame] [nvarchar](1000) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[idreklama] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  UserDefinedFunction [dbo].[pretraziKorisnika]    Script Date: 7/27/2023 6:36:07 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE function [dbo].[pretraziKorisnika](@upis nvarchar(30)) returns table 
as 
return 
SELECT ime, prezime, iskustvo, diploma, kontaktTelefon, emailKorisnik
from KORISNIK 
WHERE ime LIKE '%' + @upis + '%' OR prezime LIKE '%' +@upis + '%'
GO
/****** Object:  StoredProcedure [dbo].[dodajKorisnika]    Script Date: 7/27/2023 6:36:07 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[dodajKorisnika] (@ime nvarchar(30), @prezime nvarchar(30), @lozinka nvarchar(30), @iskustvo nvarchar(30), @diploma nvarchar(30), @telefon nvarchar(30), @email nvarchar(50))
AS
BEGIN

INSERT INTO KORISNIK( ime, prezime, lozinka, iskustvo, diploma, kontaktTelefon, emailKorisnik)
VALUES( @ime, @prezime, @lozinka, @iskustvo, @diploma, @telefon, @email)

END
GO
/****** Object:  StoredProcedure [dbo].[dodajPosao]    Script Date: 7/27/2023 6:36:07 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE procedure [dbo].[dodajPosao](@idEmployer int, @naslov nvarchar(80), @zahtevi nvarchar(1000), @lokacija nvarchar(30), @datumKraja date, @opis nvarchar(1000))
as
begin


INSERT INTO POSAO( EmployerID, naslov, zahtevi, lokacija, datumPostavljanja, datumKraja, opisPosla)
values( @idEmployer, @naslov, @zahtevi, @lokacija, GETDATE(), @datumKraja, @opis)
end
GO
/****** Object:  StoredProcedure [dbo].[dodajPrijavu]    Script Date: 7/27/2023 6:36:07 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[dodajPrijavu] (
    @idKor int,
    @idPosao int
)
AS
BEGIN
    SET NOCOUNT ON;

    IF EXISTS (
        SELECT 1
        FROM PRIJAVA
        WHERE idKorisnik = @idKor AND IdPosao = @idPosao
    )
    BEGIN
        SELECT 1 as alreadyApplied;
    END
    ELSE
    BEGIN
        DECLARE @brP int;

        SELECT @brP = ISNULL(MAX(idPrijava), 0) + 1
        FROM PRIJAVA;

        INSERT INTO PRIJAVA (idPrijava, idKorisnik, IdPosao, datumPrijave)
        VALUES (@brP, @idKor, @idPosao, GETDATE());

        SELECT 0 as alreadyApplied;
    END;
END;
GO
/****** Object:  StoredProcedure [dbo].[dodajReklamu]    Script Date: 7/27/2023 6:36:07 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[dodajReklamu](@Employer int, @kraj date, @cena int, @opis nvarchar(1000))
as
begin
declare @brR int 
SELECT @brR = count(*)
from REKLAMIRANJE
INSERT INTO REKLAMIRANJE(IdReklama, EmployerID, pocetakTrajanja, krajTrajanja, cena, opisReklame)
VALUES(@brR+1, @Employer, GETDATE(), @kraj, @cena, @opis)
END
GO
/****** Object:  StoredProcedure [dbo].[ukloniKorisnika]    Script Date: 7/27/2023 6:36:07 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
create procedure [dbo].[ukloniKorisnika](@id integer)
as 
begin
DELETE FROM KORISNIK 
WHERE idKorisnik = @id 
end
GO
/****** Object:  StoredProcedure [dbo].[ukloniPosao]    Script Date: 7/27/2023 6:36:07 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
create procedure [dbo].[ukloniPosao](@id int)
as
begin
DELETE FROM POSAO 
WHERE IdPosao = @id
end
GO
/****** Object:  Trigger [dbo].[isteklaReklama]    Script Date: 7/27/2023 6:36:07 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TRIGGER [dbo].[isteklaReklama] ON [dbo].[REKLAMIRANJE] 
AFTER UPDATE 
AS 
BEGIN
DELETE FROM REKLAMIRANJE
WHERE krajTrajanja > GETDATE()

END
GO
ALTER TABLE [dbo].[REKLAMIRANJE] ENABLE TRIGGER [isteklaReklama]
GO
USE [master]
GO
ALTER DATABASE [OnlinePortalPoslova] SET  READ_WRITE 
GO
